<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatiereProfesseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matieresParProfesseur = [
            'PROF001' => ['PWEB', 'BDD'],
            'PROF002' => ['COMPTA', 'MKT'],
            'PROF003' => ['ALGO'],
        ];

        foreach ($matieresParProfesseur as $numEmploye => $codesMatieres) {
            $professeurId = DB::table('professeurs')->where('numEmploye', $numEmploye)->value('id');

            foreach ($codesMatieres as $codeMatiere) {
                DB::table('matiere_professeur')->insert([
                    'professeur_id' => $professeurId,
                    'matiere_id' => DB::table('matieres')->where('codeMatiere', $codeMatiere)->value('id'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
