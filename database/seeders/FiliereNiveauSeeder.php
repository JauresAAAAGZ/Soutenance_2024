<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereNiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Toutes les filières ont les trois années de licence, seule l'informatique a un master
        $niveauxParFiliere = [
            'INFO' => ['L1', 'L2', 'L3', 'M1', 'M2'],
            'GC' => ['L1', 'L2', 'L3'],
            'FC' => ['L1', 'L2', 'L3'],
        ];

        foreach ($niveauxParFiliere as $codeFiliere => $codesNiveaux) {
            $filiereId = DB::table('filieres')->where('codeFiliere', $codeFiliere)->value('id');

            foreach ($codesNiveaux as $codeNiveau) {
                DB::table('filiere_niveau')->insert([
                    'filiere_id' => $filiereId,
                    'niveau_id' => DB::table('niveaux')->where('codeNiveau', $codeNiveau)->value('id'),
                ]);
            }
        }
    }
}
