<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['homme', 'femme'];

        foreach ($genres as $genre) {
            Genre::create([
                'genre' => $genre
            ]);
        }
    }
}
