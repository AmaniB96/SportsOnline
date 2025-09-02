<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        return view('home');
    }
    public function equipe(){
        return view('front.equipe');
    }
    public function show_player(){
        return view('front.show');
    }
}
