<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joueur>
 */
class JoueurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'age' => fake()->numberBetween(15,45),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'pays' => fake()->country(),
            'position_id' => null,
            'equipe_id' => null,
            'genre_id' => null,
            'user_id' => null,
        ];
    }
    public function withRole(...$arg)
    {
        return $this->state(fn (array $attributes) => [
            'position_id' => $arg[0],
            'equipe_id' => $arg[1] ?? null,
            'genre_id' => $arg[2],
        ]);
    }
}
