<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Un compte de démonstration par rôle (1 étudiant, 2 professeur, 3 admin, 4 service examen)
        $comptes = [
            [
                'name' => 'Marc Konan',
                'email' => 'marc.konan@eduflow.test',
                'role_id' => 1,
                'etudiant_id' => DB::table('etudiants')->where('matricule', 'ETU24001')->value('id'),
            ],
            [
                'name' => 'Serge Kouame',
                'email' => 'serge.kouame@eduflow.test',
                'role_id' => 2,
                'professeur_id' => DB::table('professeurs')->where('numEmploye', 'PROF001')->value('id'),
            ],
            [
                'name' => 'Administrateur',
                'email' => 'admin@eduflow.test',
                'role_id' => 3,
                'admin_id' => DB::table('admins')->where('emailAdmin', 'admin@eduflow.test')->value('id'),
            ],
            [
                'name' => 'Service des examens',
                'email' => 'examens@eduflow.test',
                'role_id' => 4,
            ],
        ];

        foreach ($comptes as $compte) {
            DB::table('users')->updateOrInsert(
                ['email' => $compte['email']],
                $compte + [
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
