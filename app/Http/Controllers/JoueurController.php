<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Equipe;
use App\Models\Genre;
use App\Models\Joueur;
use App\Models\Photo;
use Illuminate\Http\Request;

class JoueurController extends Controller
{
    public function index() {
        $joueurs = Joueur::orderBy('equipe_id','desc')->get();
        return view('back.player', compact('joueurs'));
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
        ]);

        $joueur = new Joueur();
        $joueur->nom = $request->nom; 
        $joueur->prenom = $request->prenom; 
        $joueur->age = $request->age; 
        $joueur->phone = $request->phone; 
        $joueur->email = $request->email; 
        $joueur->pays = $request->pays;
        $joueur->position_id = $request->position_id;
        $joueur->genre_id = $request->genre_id;
        $joueur->user_id = auth()->id();
        
        $joueur->save();

        $photo = new Photo();
        $file = $request->file('image');
        $filename = time().''.$file->GetClientOriginalName();
        $path = $file->storeAs('joueurs', $filename, 'public');
        $photo->src = $path;
        $photo->joueur_id = $request->joueur->id;
        
        $photo->save();

        return redirect()->back();
    }

    public function show($id) {
        $joueur = Joueur::findOrFail($id);
        $genres = Genre::all();
        $equipes = Equipe::all();
        $positions = Position::all();
        return view('back.player_show', compact('joueur', 'genres', 'equipes', 'positions'));
    }

    public function update(Request $request, $id) {

        $request->validate([
            'email' => ['unique', 'email', 'required']
        ]);

        $joueur = Joueur::findOrFail($id);
        $joueur->nom = $request->nom; 
        $joueur->prenom = $request->prenom; 
        $joueur->age = $request->age; 
        $joueur->phone = $request->phone; 
        $joueur->email = $request->email; 
        $joueur->pays = $request->pays;
        
        $joueur->update();

        $photo = Photo::findOrFail($id);
        $file = $request->file('image');
        $filename = time().''.$file->GetClientOriginalName();
        $path = $file->storeAs('joueurs', $filename, 'public');
        $photo->src = $path;
        
        $photo->update();

        return redirect()->route('back.player.show');
    }

    public function destroy($id) {
        Joueur::findOrFail($id)->delete();
        return redirect()->back();
    }
}
