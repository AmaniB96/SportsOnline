<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Joueur;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        $equipes = Equipe::all();
        $joueurs = Joueur::all();
        return view('home',compact('equipes','joueurs'));
    }
    public function equipe(){
        $equipes = Equipe::all();
        return view('front.equipe');
    }
    public function show_player($id){
        $equipe = Equipe::findOrFail($id);
        return view('front.show_player',compact('equipe'));
    }
    public function back(){
        return view('back.home');
    }
}
