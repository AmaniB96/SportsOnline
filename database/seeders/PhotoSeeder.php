<?php

namespace Database\Seeders;

use App\Models\Joueur;
use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $MenPlayer = ['storage/joueurs/joueur1.png', 'storage/joueurs/joueur2.png', 'storage/joueurs/joueur3.png', 'storage/joueurs/joueur4.png', 'storage/joueurs/joueur5.png'];
        $WomenPlayer = ['storage/joueurs/joueuse1.png', 'storage/joueurs/joueuse2.png', 'storage/joueurs/joueuse3.png'];

        $joueurs = Joueur::whereHas('genre', function($query) {
            $query->where('nom', 'homme');
        })->get();
        $joueuses = Joueur::whereHas('genre', function($query) {
            $query->where('nom', 'homme');
        })->get();

        foreach ($joueurs as $joueur) {
            Photo::create([
                'src' => $MenPlayer[array_rand($MenPlayer)],
                'joueur_id' => $joueur->id
            ]);
        }

        foreach ($joueuses as $joueuse) {
            Photo::create([
                'src' => $WomenPlayer[array_rand($WomenPlayer)],
                'joueur_id' => $joueuse->id
            ]);
        }
    }
}
