<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Etudiant::factory(1)->create();
        \App\Models\Professeur::factory(1)->create();
        /*\App\Models\Etudiant::factory()->create([
            'nomEtudiant' => 'Test',
            'prenomEtudiant' => 'User',
            'emailEtudiant' => 'test1@example.com',
            'email_verified_at' => now(),
            'pswdEtudiant' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);*/
    }
    
}
