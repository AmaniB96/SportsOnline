<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Joueur;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class JoueurController extends Controller
{
    public function index()
    {
        // Eager-load avec la bonne relation : 'user.role' (singulier)
        $allJoueurs = Joueur::with(['photo', 'equipe', 'position', 'genre', 'user.role'])->get();

        // 1. Récupérer les joueurs de l'utilisateur connecté
        $mesJoueurs = $allJoueurs->where('user_id', auth()->id());

        // 2. Créer la variable manquante en groupant les autres joueurs
        $joueursParRoleEtUser = $allJoueurs
            ->where('user_id', '!=', auth()->id()) // Exclure les joueurs de l'utilisateur connecté
            ->groupBy(function ($joueur) {
                // Groupe principal : par nom du rôle de l'utilisateur associé
                // Utilise la relation 'role' (singulier) et accède à la propriété 'role' (ou 'name' si c'est le nom de ta colonne)
                if (!$joueur->user || !$joueur->user->role) {
                    return 'sans_role'; // Cas où le joueur n'a pas d'utilisateur ou l'utilisateur n'a pas de rôle
                }
                return strtolower($joueur->user->role->role ?? 'user'); // Accède au nom du rôle
            })
            ->map(function ($joueursByRole) {
                // Sous-groupe : par ID de l'utilisateur
                return $joueursByRole->groupBy('user_id');
            });

        // 3. Passer toutes les variables à la vue
        return view('back.player', compact('mesJoueurs', 'joueursParRoleEtUser'));
    }

    public function create()
    {
        $joueurs = Joueur::all();
        $genres = Genre::all();
        $equipes = Equipe::all();
        $positions = Position::all();
        return view('back.player_create', compact('joueurs', 'genres', 'equipes', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|min:2',
            'prenom' => 'required|string|min:2',
            'age' => 'required|integer',
            'phone' => 'required|string',
            'email' => 'required|email|unique:joueurs,email',
            'pays' => 'required|string',
            'position_id' => 'required|exists:positions,id',
            'equipe_id' => 'nullable|integer|exists:equipes,id',
            'genre_id' => 'required|integer|exists:genres,id',
            'image' => ['nullable','image','max:2048']
        ]);

        DB::beginTransaction();
        try {
            if ($request->equipe_id) {
                $equipe = Equipe::where('id', $request->equipe_id)->lockForUpdate()->first();
                if (! $equipe) {
                    DB::rollBack();
                    return back()->withInput()->with('error', 'Équipe introuvable.');
                }

                $equipeGenreStr = strtolower($equipe->genre->genre ?? 'mixte');
                $selectedGenreStr = strtolower(Genre::find($request->genre_id)->genre ?? '');

                if ($equipeGenreStr !== 'mixte' && $selectedGenreStr !== $equipeGenreStr) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "Genre incompatible avec l'équipe sélectionnée.");
                }

                if ($equipe->joueurs()->count() >= 15) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "L'équipe est pleine (15 joueurs).");
                }

                if ($equipe->joueurs()->where('position_id', $request->position_id)->count() >= 4) {
                    DB::rollBack();
                    return back()->withInput()->with('error', 'Limite atteinte pour ce poste (4 joueurs).');
                }
            }

            $joueur = Joueur::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'age' => $request->age,
                'phone' => $request->phone,
                'email' => $request->email,
                'pays' => $request->pays,
                'equipe_id' => $request->equipe_id ?? null,
                'position_id' => $request->position_id,
                'genre_id' => $request->genre_id,
                'user_id' => auth()->id(),
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->storeAs('joueurs', $filename, 'public');
                Photo::create([
                    'src' => "storage/{$path}",
                    'joueur_id' => $joueur->id
                ]);
            }

            DB::commit();
            return redirect()->route('back.player.index')->with('success', 'Joueur créé avec succès.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Erreur serveur. Réessayez.');
        }
    }

    public function show($id)
    {
        $joueur = Joueur::findOrFail($id);
        $this->authorize('view', $joueur);

        $genres = Genre::all();
        $equipes = Equipe::all();
        $positions = Position::all();

        return view('back.player_show', compact('joueur', 'genres', 'equipes', 'positions'));
    }

    public function update(Request $request, $id)
    {
        $joueur = Joueur::findOrFail($id);
        $this->authorize('update', $joueur);

        $request->validate([
            'nom' => 'required|string|min:2',
            'prenom' => 'required|string|min:2',
            'age' => 'required|integer',
            'phone' => 'required|string',
            'email' => ['required','email', Rule::unique('joueurs')->ignore($joueur->id)],
            'pays' => 'required|string',
            'position_id' => 'required|exists:positions,id',
            'equipe_id' => 'nullable|integer|exists:equipes,id',
            'genre_id' => 'required|integer|exists:genres,id',
            'image' => ['nullable','image','max:2048']
        ]);

        DB::beginTransaction();
        try {
            if ($request->equipe_id) {
                $equipe = Equipe::where('id', $request->equipe_id)->lockForUpdate()->first();
                if (! $equipe) {
                    DB::rollBack();
                    return back()->withInput()->with('error', 'Équipe introuvable.');
                }

                $equipeGenreStr = strtolower($equipe->genre->genre ?? 'mixte');
                $selectedGenreStr = strtolower(Genre::find($request->genre_id)->genre ?? '');

                if ($equipeGenreStr !== 'mixte' && $selectedGenreStr !== $equipeGenreStr) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "Genre incompatible avec l'équipe sélectionnée.");
                }

                if ($equipe->joueurs()->where('id', '!=', $joueur->id)->count() >= 15) {
                    DB::rollBack();
                    return back()->withInput()->with('error', "L'équipe est pleine (15 joueurs).");
                }

                if ($equipe->joueurs()->where('position_id', $request->position_id)->where('id', '!=', $joueur->id)->count() >= 4) {
                    DB::rollBack();
                    return back()->withInput()->with('error', 'Limite atteinte pour ce poste (4 joueurs).');
                }
            }

            $joueur->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'age' => $request->age,
                'phone' => $request->phone,
                'email' => $request->email,
                'pays' => $request->pays,
                'position_id' => $request->position_id,
                'genre_id' => $request->genre_id,
                'equipe_id' => $request->equipe_id ?? null,
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = $file->storeAs('joueurs', $filename, 'public');

                $photo = Photo::firstOrNew(['joueur_id' => $joueur->id]);
                $photo->src = "storage/{$path}";
                $photo->save();
            }

            DB::commit();
            return redirect()->route('back.player.index')->with('success', 'Joueur mis à jour.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Erreur serveur. Réessayez.');
        }
    }

    public function destroy($id)
    {
        $joueur = Joueur::findOrFail($id);
        $this->authorize('delete', $joueur);
        $joueur->delete();

        return redirect()->route('back.player.index')->with('success', 'Joueur supprimé avec succès.');
    }
}
