<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $professeurs = [
            ['numEmploye' => 'PROF001', 'nomProfesseur' => 'Kouame', 'prenomProfesseur' => 'Serge', 'emailProfesseur' => 'serge.kouame@eduflow.test', 'sexe_prof' => 'Masculin', 'date_naissance_prof' => '1982-04-12'],
            ['numEmploye' => 'PROF002', 'nomProfesseur' => 'Bamba', 'prenomProfesseur' => 'Aminata', 'emailProfesseur' => 'aminata.bamba@eduflow.test', 'sexe_prof' => 'Féminin', 'date_naissance_prof' => '1986-09-03'],
            ['numEmploye' => 'PROF003', 'nomProfesseur' => 'Yao', 'prenomProfesseur' => 'Christian', 'emailProfesseur' => 'christian.yao@eduflow.test', 'sexe_prof' => 'Masculin', 'date_naissance_prof' => '1979-01-25'],
        ];

        foreach ($professeurs as $professeur) {
            DB::table('professeurs')->insert($professeur + ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
