<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/equipe', [HomeController::class, 'equipe'])->name('home.equipe');
Route::get('/show/{id}', [HomeController::class, 'show'])->name('home.show');

Route::resource('back/player', JoueurController::class)->names('back.player');
Route::resource('back/equipe', EquipeController::class)->names('back.equipe');
Route::resource('back/user',UserController::class)->names('back.user');

Route::get('/show/{id}', [JoueurController::class, 'show'])->name('joueur.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

