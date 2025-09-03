<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $equipes = Equipe::all();
        $joueurs = Joueur::all();

        $equipesEurope = Equipe::whereHas('continent', function($query) {
            $query->where('nom', 'Europe');
        })->get();

        $joueursEurope = Joueur::whereHas('equipe.continent', function($query) {
            $query->where('nom', 'Europe');
        })->whereHas('genre', function($query) {
            $query->where('genre', 'homme');
        })->inRandomOrder()->limit(8)->with(['equipe', 'photo', 'position'])->get();

        $equipesHorsEurope = Equipe::whereHas('continent', function($query) {
            $query->where('nom', '!=', 'Europe');
        })->inRandomOrder()->limit(4)->get();

        $joueusesHorsEurope = Joueur::whereHas('equipe.continent', function($query) {
            $query->where('nom', '!=', 'Europe');
        })->whereHas('genre', function($query) {
            $query->where('genre', 'femme');
        })->inRandomOrder()->limit(8)->with(['equipe', 'photo', 'position'])->get();

        $joueursSansEquipe = Joueur::whereNull('equipe_id')
            ->inRandomOrder()->limit(4)->with(['photo', 'position'])->get();

        return view('home',compact('equipes','joueurs', 'equipesEurope', 'joueursEurope', 'equipesHorsEurope', 'joueusesHorsEurope', 'joueursSansEquipe'));
    }
    public function equipe(){
        $equipes = Equipe::with('joueurs.position', 'joueurs.genre')->get();;
        return view('front.equipe', compact('equipes'));
    }
    public function show($id){
        $joueur = Joueur::findOrFail($id);
        return view('front.show_player',compact( 'joueur'));
    }
    public function back(){
        return view('back.home');
    }

    public function joueurs(Request $request){
    $query = Joueur::with(['equipe', 'photo', 'position', 'genre']);
    
    // Filtrer par genre si spécifié
    if ($request->has('genre')) {
        if ($request->genre == 'Masculin') {
            $query->whereHas('genre', function($q) {
                $q->where('genre', 'homme');
            });
        } elseif ($request->genre == 'Féminin') {
            $query->whereHas('genre', function($q) {
                $q->where('genre', 'femme');
            });
        }
    }
    
    $joueurs = $query->get();
    
    return view('front.joueur', compact('joueurs'));
}    

    public function showEquipe($id)
    {
        $equipe = Equipe::with(['joueurs.position', 'joueurs.genre', 'joueurs.photo', 'genre', 'continent'])->findOrFail($id);
        return view('front.show_equipe', compact('equipe'));
    }
}
