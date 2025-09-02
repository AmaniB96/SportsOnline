<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoueurController extends Controller
{
    public function index(){
        return view('back.player');
    }
    public function show($id){
        return view('back.player_show');
    }
    public function create(){
        return view('back.player_create');
    }
    public function store(){
        
        return redirect()->Route('back.player');
    }
    public function destroy($id){
        return redirect()->Route('back.player');
    }
    public function update($id){
        return redirect()->Route('back.player');
    }
}
