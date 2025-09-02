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
        $joueurs = Joueur::all();
        return view('back.player_index', compact('joueurs'));
    }
    
    public function create() {
        $joueurs = Joueur::all();
        $genres = Genre::all();
        $equipes = Equipe::all();
        $photos = Photo::all();
        $positions = Position::all();
        return view('back.player_create', compact('joueurs', 'genres', 'equipes', 'photos', 'positions'));
    }

    public function store(Request $request) {

        $request->validate([
            'email' => ['unique', 'email', 'required']
        ]);

        $joueur = new Joueur();
        $joueur->nom = $request->nom; 
        $joueur->prenom = $request->prenom; 
        $joueur->age = $request->age; 
        $joueur->phone = $request->phone; 
        $joueur->email = $request->email; 
        $joueur->pays = $request->pays;
        
        $joueur->save();

        $photo = new Photo();
        $file = $request->file('image');
        $filename = time().''.$file->GetClientOriginalName();
        $path = $file->storeAs('joueurs', $filename, 'public');
        $photo->src = $path;
        
        $photo->save();

        return redirect()->route('home');
    }

    public function edit($id) {
        $joueurs = Joueur::findOrFail($id);
        $genres = Genre::all();
        $equipes = Equipe::all();
        $positions = Position::all();
        return view('back.player_index', compact('joueurs', 'genres', 'equipes', 'photos', 'positions'));
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

        return redirect()->route('home');
    }

    public function destroy($id) {
        Joueur::findOrFail($id)->delete();
        return redirect()->route('home')
    }
}
