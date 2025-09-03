<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use App\Models\Equipe;
use App\Models\Genre;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index(){
        $equipes = Equipe::all();
        return view('back.equipe',compact('equipes'));
    }
    public function show($id){
        $equipe = equipe::findOrFail($id);
        $genres = Genre::all();
        $continents = Continent::all();
        return view('back.equipe_show',compact('equipe','genres','continents'));
    }
    public function create(){
        $genres = Genre::all();
        $continents = Continent::all();
        return view('back.player_create',compact('genres','continents'));
    }
    public function store(){
        request()->validate([
            'nom' => ['required', 'string', 'min:6'],
            'ville' => ['required', 'string', 'min:6'],
            'continent_id' => ['required', 'integer', 'exists:continents,id'],
            'genre_id' => ['nullable', 'integer', 'exists:genres,id'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        if (request()->hasFile('logo')) {
            $file = request()->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('logo', $filename, 'public');
            $pathSt = "storage/$path";
        } else {
            $pathSt = 'storage/logo/default_equipe.png';
        }

        Equipe::create([
            'nom'=>request('nom'),
            'ville'=>request('ville'),
            'continent_id'=>request('continent_id'),
            'genre_id'=>request('genre_id'),
            'logo'=>$pathSt,
        ]);
        return redirect()->Route('back.equipe.index');
    }
    public function destroy($id){
        Equipe::findOrFail($id)->delete();
        return redirect()->Route('back.equipe.index');
    }
    public function update($id,Request $request){
        
        $equipe = Equipe::findOrFail($id);
        $genre_id = request('genre_id') === '' ? null : request('genre_id');

        if ($request->hasFile('logo')){
            $file = $request->file('image');
            $filename = time().''.$file->GetClientOriginalName();
            $path = $file->storeAs('joueurs', $filename, 'public');
            $equipe->logo = $path;
        }
        
        $equipe->update([
            'nom' => request('nom'),
            'ville' => request('ville'),
            'continent_id' => request('continent_id'),
            'genre_id' => $genre_id,
        ]);
        return redirect()->Route('back.equipe.index');
    }
}
