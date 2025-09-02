<?php

namespace Database\Seeders;

use App\Models\Joueur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JoueurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i <= 7; $i++) { 
            Joueur::factory()->count(2)->withRole(1,$i,1)->create();
            Joueur::factory()->count(2)->withRole(2,$i,1)->create();
            Joueur::factory()->count(2)->withRole(3,$i,1)->create();
            Joueur::factory()->count(1)->withRole(4,$i,1)->create();
        }
         
        Joueur::factory()->count(2)->withRole(1,8,2)->create();
        Joueur::factory()->count(2)->withRole(2,8,2)->create();
        Joueur::factory()->count(2)->withRole(3,8,2)->create();
        Joueur::factory()->count(1)->withRole(4,8,2)->create();
        
    }
}
