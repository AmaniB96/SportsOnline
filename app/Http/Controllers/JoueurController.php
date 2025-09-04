<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Joueur;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JoueurController extends Controller
{
    public function index() {
        $joueurs = Joueur::orderBy('equipe_id','desc')->get();
        $mesJoueurs = Joueur::where('user_id', auth()->id())->get();
        
        $joueursAvecUser = Joueur::with('user')->get();

        $joueursParRoleEtUser = $joueursAvecUser->groupBy(function($joueur) {
            if (!$joueur->user) {
                return 'sans_user';
            }
            return $joueur->user->role_id == 1 ? 'user' : 'coach';
        })->map(function($group) {
            return $group->groupBy(function($joueur) {
                return $joueur->user_id ?? 'inconnu';
            });
        });

        $joueursUser = $joueursParRoleEtUser->get('user', collect());

        $joueursCoach = $joueursParRoleEtUser->get('coach', collect());
        return view('back.player', compact('joueurs', 'mesJoueurs', 'joueursUser', 'joueursCoach', 'joueursParRoleEtUser','joueursUser','joueursCoach'));
    }

    
    public function create() {
        $joueurs = Joueur::all();
        $genres = Genre::all();
        $equipes = Equipe::all();
        $positions = Position::all();
        return view('back.player_create', compact('joueurs', 'genres', 'equipes', 'positions'));
    }

    public function store(Request $request) {

        $request->validate([
            'nom' => 'required|string|min:2',
            'prenom' => 'required|string|min:2',
            'age' => 'required|integer',
            'phone' => 'required|string',
            'email' => 'required|email|unique:joueurs,email',
            'pays' => 'required|string',
            'image' => [ 'required','image','max:2048' ]
        ]);

        
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().''.$file->getClientOriginalName();
            $path = $file->storeAs('joueurs', $filename, 'public');
            $pathSt = "storage/$path";
            
            $joueur = Joueur::create([
                'nom' => $request->nom, 
                'prenom' => $request->prenom, 
                'age' => $request->age, 
                'phone' => $request->phone, 
                'email' => $request->email, 
                'pays' => $request->pays,
                'equipe_id' => $request->equipe_id,
                'position_id' => $request->position_id,
                'genre_id' => $request->genre_id,
                'user_id' => auth()->id(),
            ]);
            Photo::create([
                'src' => $pathSt,
                'joueur_id' => $joueur->id
            ]);
        }


        

        return redirect()->route('back.player.show',$joueur->id)->with('success','joueur crée');
    }

    public function show($id) {
        $joueur = Joueur::findOrFail($id);
        $genres = Genre::all();
        $equipes = Equipe::all();
        $positions = Position::all();
        $this->authorize('view', $joueur);
        return view('back.player_show', compact('joueur', 'genres', 'equipes', 'positions'));
    }

    public function update(Request $request, $id) {
        
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
        ]);
        $joueur = Joueur::findOrFail($id);
        $this->authorize('update', $joueur);


        $joueur->nom = $request->nom; 
        $joueur->prenom = $request->prenom; 
        $joueur->age = $request->age; 
        $joueur->phone = $request->phone;
        $joueur->equipe_id = $request->equipe_id;
        $joueur->email = $request->email; 
        $joueur->pays = $request->pays;
        $joueur->position_id = $request->position_id;
        $joueur->genre_id = $request->genre_id;
        
        $joueur->update();

        if($request->hasFile('image')){
            $photo = Photo::findOrFail($id);
            $file = $request->file('image');
            $filename = time().''.$file->getClientOriginalName();
            $path = $file->storeAs('joueurs', $filename, 'public');
            $pathSt = "storage/$path";
            $photo->src = $pathSt;
            
            $photo->update();
        }

        return redirect()->route('back.player.show',$joueur->id);
    }

    public function destroy($id) {
        $joueur = Joueur::findOrFail($id);

        $this->authorize('delete', $joueur);

        $joueur->delete();

        return redirect()->route('back.player.index')
                        ->with('success', 'Joueur supprimé avec succès.');
    }
}
