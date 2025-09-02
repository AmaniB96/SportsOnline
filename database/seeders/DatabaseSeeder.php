<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(GenreSeeder::class);
         $this->call(ContinentSeeder::class);
        $this->call(EquipeSeeder::class);
        $this->call(JoueurSeeder::class);
        $this->call(PhotoSeeder::class);
    }
}
