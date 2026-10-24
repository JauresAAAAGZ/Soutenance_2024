<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepotNiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveauxParDepot = [
            'Projet Laravel - Gestion de bibliothèque' => ['L3', 'M1'],
            'TP Modélisation MERISE' => ['L3'],
            'Exercices de tri et de recherche' => ['L3'],
            'Étude de cas - Bilan comptable' => ['L3'],
        ];

        foreach ($niveauxParDepot as $nomDepot => $codesNiveaux) {
            $depotId = DB::table('depots')->where('nomDepot', $nomDepot)->value('id');

            foreach ($codesNiveaux as $codeNiveau) {
                DB::table('depot_niveau')->insert([
                    'depot_id' => $depotId,
                    'niveau_id' => DB::table('niveaux')->where('codeNiveau', $codeNiveau)->value('id'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
