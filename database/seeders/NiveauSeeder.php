<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveaux = [
            ['diplome_niveau' => 'Licence 1', 'codeNiveau' => 'L1'],
            ['diplome_niveau' => 'Licence 2', 'codeNiveau' => 'L2'],
            ['diplome_niveau' => 'Licence 3', 'codeNiveau' => 'L3'],
            ['diplome_niveau' => 'Master 1', 'codeNiveau' => 'M1'],
            ['diplome_niveau' => 'Master 2', 'codeNiveau' => 'M2'],
        ];

        foreach ($niveaux as $niveau) {
            DB::table('niveaux')->insert($niveau + ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
