<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index(){
        $equipes = Equipe::all();
        return view('back.equipe',compact('equipes'));
    }
    public function show($id){
        $equipe = equipe::findOrFail($id);
        return view('back.equipe_show',compact('equipe'));
    }
    public function create(){
        return view('back.player_create');
    }
    public function store(){
        Equipe::create([
            'nom'=>request('nom'),
            'ville'=>request('ville'),
            'continent_id'=>request('continent_id'),
            'genre_id'=>request('genre_id'),
            'logo'=>request('logo'),
        ]);
        return redirect()->Route('back.equipe');
    }
    public function destroy($id){
        Equipe::findOrFail($id)->delete();
        return redirect()->Route('back.equipe');
    }
    public function update($id){
        Equipe::findOrFail($id)->update([
            'nom'=>request('nom'),
            'ville'=>request('ville'),
            'continent_id'=>request('continent_id'),
            'genre_id'=>request('genre_id'),
            'logo'=>request('logo'),
        ]);
        return redirect()->Route('back.equipe');
    }
}
