<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepotFiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filiereParDepot = [
            'Projet Laravel - Gestion de bibliothèque' => 'INFO',
            'TP Modélisation MERISE' => 'INFO',
            'Exercices de tri et de recherche' => 'INFO',
            'Étude de cas - Bilan comptable' => 'FC',
        ];

        foreach ($filiereParDepot as $nomDepot => $codeFiliere) {
            DB::table('depot_filiere')->insert([
                'depot_id' => DB::table('depots')->where('nomDepot', $nomDepot)->value('id'),
                'filiere_id' => DB::table('filieres')->where('codeFiliere', $codeFiliere)->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
