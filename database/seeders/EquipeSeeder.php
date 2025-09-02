<?php

namespace Database\Seeders;

use App\Models\Equipe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipes = [
            [
                'nom' => 'Real Madrid CF',
                'ville' => 'Madrid',
                'continent_id' => 4,
                'genre_id' => 1,
                'logo' => 'storage/logo/Real_Madrid_CF.svg'
            ],
            [
                'nom' => 'Paris Saint-Germain',
                'ville' => 'Paris',
                'continent_id' => 4,
                'genre_id' => 1,
                'logo' => 'storage/logo/Paris_Saint-Germain_F.C..svg'
            ],
            [
                'nom' => 'Manchester City FC',
                'ville' => 'Manchester',
                'continent_id' => 4,
                'genre_id' => 1,
                'logo' => 'storage/logo/Manchester_City_FC_badge.svg'
            ],
            [
                'nom' => 'Al Ahly SC',
                'ville' => 'Le Caire',
                'continent_id' => 1,
                'genre_id' => 1,
                'logo' => 'storage/logo/Al_Ahly_SC.png'
            ],
            [
                'nom' => 'Flamengo',
                'ville' => 'Rio de Janeiro',
                'continent_id' => 2,
                'genre_id' => 1,
                'logo' => 'storage/logo/Logo_CR_Flamengo.svg.png'
            ],
            [
                'nom' => 'Al Hilal SFC',
                'ville' => 'Riyad',
                'continent_id' => 3,
                'genre_id' => 1,
                'logo' => 'storage/logo/Al_Hilal_SFC.png'
            ],
            [
                'nom' => 'Melbourne City FC Women',
                'ville' => 'Melbourne',
                'continent_id' => 5,
                'genre_id' => 2,
                'logo' => 'storage/logo/Melbourne_City_FC.svg.png'
            ],
        ];
        foreach ($equipes as $equipe) {
            Equipe::create($equipe);
        }
    }
}
