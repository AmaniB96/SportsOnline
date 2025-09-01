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
        $MenPlayer = ['joueur1.png', 'joueur2.png', 'joueur3.png', 'joueur4.png', 'joueur5.png'];
        $WomenPlayer = ['joueuse1.png', 'joueuse2.png', 'joueuse3.png'];

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
