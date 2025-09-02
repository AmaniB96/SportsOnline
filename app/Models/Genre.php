<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable =['genre'];

    public function joueur() {
        return $this->hasMany(Joueur::class);
    }
    public function equipe() {
        return $this->hasMany(Equipe::class);
    }
    
}
