<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = [
            ['nomFiliere' => 'Informatique', 'codeFiliere' => 'INFO'],
            ['nomFiliere' => 'Gestion Commerciale', 'codeFiliere' => 'GC'],
            ['nomFiliere' => 'Finance Comptabilité', 'codeFiliere' => 'FC'],
        ];

        foreach ($filieres as $filiere) {
            DB::table('filieres')->insert($filiere + ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
