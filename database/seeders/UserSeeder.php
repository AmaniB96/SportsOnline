<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->withRole(3)->create();
        User::factory()->count(3)->withRole(2)->create();
        User::factory()->count(10)->withRole(1)->create();
    }
}
