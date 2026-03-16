<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ville;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'adresse' => $this->faker->address,
            'telephone' => $this->faker->phoneNumber,
            'email' => fake()->unique()->safeEmail(),
            'date_de_naissance' => $this->faker->date(),
            'ville_id' => Ville::inRandomOrder()->first()->id,
            'user_id' => User::factory(),
        ];
    }
}
