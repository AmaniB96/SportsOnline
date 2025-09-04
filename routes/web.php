<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\JoueurController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\ConnecterVerif;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/equipe', [HomeController::class, 'equipe'])->name('home.equipe');
Route::get('/joueurs', [HomeController::class, 'joueurs'])->name('home.joueur');
Route::get('/equipe/joueur/{id}', [HomeController::class, 'show'])->name('home.show');
Route::get('/equipe/{id}', [HomeController::class, 'showEquipe'])->name('home.equipe.show');

// Route::get('/back', [HomeController::class, 'back'])->name('back');
Route::resource('back/player', JoueurController::class)->names('back.player');
Route::resource('back/equipe', EquipeController::class)->names('back.equipe');
Route::resource('back/user',ProfileController::class)->names('back.user');

Route::put("back/role/update/{id}",[RoleController::class,'update'])->name('back.role.update');

Route::get('/show/{id}', [JoueurController::class, 'show'])->name('joueur.show');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

