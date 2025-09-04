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
        $mesJoueurs = Joueur::where('user_id', auth()->id())->get();
        $joueursUser = Joueur::whereHas('user', function ($query) {
            $query->where('role_id', 2);
        })->get();
        return view('back.player', compact('joueurs','joueursUser','mesJoueur'));
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
        $filename = time().''.$file->getClientOriginalName();
        $path = $file->storeAs('joueurs', $filename, 'public');
        $pathSt = "storage/$path";
        $photo->src = $pathSt;
        
        $photo->update();

        return redirect()->route('back.player.show');
    }

    public function destroy($id) {
        Joueur::findOrFail($id)->delete();
        return redirect()->route('back.player.index');
    }
}
