<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtudiantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $etudiants = [
            ['matricule' => 'ETU24001', 'nomEtudiant' => 'Konan', 'prenomEtudiant' => 'Marc', 'emailEtudiant' => 'marc.konan@eduflow.test', 'date_naissance_etu' => '2002-05-14', 'sexe_etu' => 'Masculin', 'filiere' => 'INFO', 'niveau' => 'L3'],
            ['matricule' => 'ETU24002', 'nomEtudiant' => 'Diomande', 'prenomEtudiant' => 'Awa', 'emailEtudiant' => 'awa.diomande@eduflow.test', 'date_naissance_etu' => '2003-02-08', 'sexe_etu' => 'Féminin', 'filiere' => 'INFO', 'niveau' => 'L3'],
            ['matricule' => 'ETU24003', 'nomEtudiant' => 'Ouattara', 'prenomEtudiant' => 'Ibrahim', 'emailEtudiant' => 'ibrahim.ouattara@eduflow.test', 'date_naissance_etu' => '2001-11-21', 'sexe_etu' => 'Masculin', 'filiere' => 'INFO', 'niveau' => 'M1'],
            ['matricule' => 'ETU24004', 'nomEtudiant' => 'Kone', 'prenomEtudiant' => 'Mariam', 'emailEtudiant' => 'mariam.kone@eduflow.test', 'date_naissance_etu' => '2003-07-30', 'sexe_etu' => 'Féminin', 'filiere' => 'GC', 'niveau' => 'L2'],
            ['matricule' => 'ETU24005', 'nomEtudiant' => 'Assi', 'prenomEtudiant' => 'Jean-Luc', 'emailEtudiant' => 'jeanluc.assi@eduflow.test', 'date_naissance_etu' => '2002-12-02', 'sexe_etu' => 'Masculin', 'filiere' => 'FC', 'niveau' => 'L3'],
        ];

        foreach ($etudiants as $etudiant) {
            $filiereId = DB::table('filieres')->where('codeFiliere', $etudiant['filiere'])->value('id');
            $niveauId = DB::table('niveaux')->where('codeNiveau', $etudiant['niveau'])->value('id');

            unset($etudiant['filiere'], $etudiant['niveau']);

            DB::table('etudiants')->insert($etudiant + [
                'filiere_id' => $filiereId,
                'niveau_id' => $niveauId,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
