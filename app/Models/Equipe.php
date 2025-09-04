<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = ['nom','ville','continent_id','genre_id','logo','user_id'];
    public function genre(){
        return $this->belongsTo(Genre::class);
    }
    public function continent(){
        return $this->belongsTo(Continent::class);
    }
    
    public function joueurs() {
        return $this->hasMany(Joueur::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
