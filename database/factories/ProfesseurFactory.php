<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professeur>
 */
class ProfesseurFactory extends Factory
{

    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numEmploye'=>'PROF' . mt_rand(10, 999),
            'nomProfesseur' => fake()->name(),
            'prenomProfesseur' => fake()->name(),
            'emailProfesseur'=>fake()->unique()->safeEmail(),
            'sexe_prof'=>'Masculin',
            'date_naissance_prof' => $this->faker->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
           
        ];
    }
}
