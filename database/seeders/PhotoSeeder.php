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
        $MenPlayer = ['/joueurs/joueur1.png', '/joueurs/joueur2.png', '/joueurs/joueur3.png', '/joueurs/joueur4.png', '/joueurs/joueur5.png'];
        $WomenPlayer = ['/joueurs/joueuse1.png', '/joueurs/joueuse2.png', '/joueurs/joueuse3.png'];

        $joueurs = Joueur::where('genre','homme')->get();
        $joueuses = Joueur::where('genre', 'femme')->get();

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
