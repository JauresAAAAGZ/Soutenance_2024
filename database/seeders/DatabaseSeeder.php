<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            NiveauSeeder::class,
            FiliereSeeder::class,
            FiliereNiveauSeeder::class,
            MatiereSeeder::class,
            ProfesseurSeeder::class,
            MatiereProfesseurSeeder::class,
            EtudiantSeeder::class,
            AdminSeeder::class,
            ServiceExamenSeeder::class,
            DepotSeeder::class,
            DepotFiliereSeeder::class,
            DepotNiveauSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
