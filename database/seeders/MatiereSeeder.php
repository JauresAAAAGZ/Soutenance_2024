<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matieres = [
            ['intitule' => 'Programmation Web', 'codeMatiere' => 'PWEB', 'duree' => '40h'],
            ['intitule' => 'Base de données', 'codeMatiere' => 'BDD', 'duree' => '30h'],
            ['intitule' => 'Algorithmique', 'codeMatiere' => 'ALGO', 'duree' => '30h'],
            ['intitule' => 'Comptabilité générale', 'codeMatiere' => 'COMPTA', 'duree' => '35h'],
            ['intitule' => 'Marketing', 'codeMatiere' => 'MKT', 'duree' => '25h'],
        ];

        foreach ($matieres as $matiere) {
            DB::table('matieres')->insert($matiere + ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
