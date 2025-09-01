<?php

namespace Database\Seeders;

use App\Models\Continent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContinentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $continents = [
            "Afrique",
            "Amériques",
            "Asie",
            "Europe",
            "Océanie"
        ];
        foreach ($continents as $continent) {
            Continent::create([
                'nom'=>$continent,
            ]);
        }
    }
}
