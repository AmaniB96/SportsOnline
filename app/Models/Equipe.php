<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $fillable = ['nom','ville','continent_id','genre_id','logo'];
    public function genre(){
        return $this->belongsTo(Genre::class);
    }
    public function continent(){
        return $this->belongsTo(Continent::class);
    }
}
