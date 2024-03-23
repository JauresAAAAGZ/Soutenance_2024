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
            //'numEmploye'=>
            'nomProfesseur' => fake()->name(),
            'prenomProfesseur' => fake()->name(),
            'emailProfesseur'=>fake()->unique()->safeEmail(),
           'pswdProfesseur' => static::$password ??= Hash::make('password'),
        ];
    }
}
