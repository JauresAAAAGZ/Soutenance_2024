<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $depots = [
            [
                'nomDepot' => 'Projet Laravel - Gestion de bibliothèque',
                'description' => 'Déposer le code source compressé et le rapport en PDF.',
                'dateCreation' => now()->subDays(5),
                'dateFermeture' => now()->addDays(10),
                'etat' => 'ouvert',
                'professeur' => 'PROF001',
                'matiere' => 'PWEB',
            ],
            [
                'nomDepot' => 'TP Modélisation MERISE',
                'description' => 'MCD et MLD de la base de données du cas pratique.',
                'dateCreation' => now()->subDays(20),
                'dateFermeture' => now()->subDays(3),
                'etat' => 'fermé',
                'professeur' => 'PROF001',
                'matiere' => 'BDD',
            ],
            [
                'nomDepot' => 'Exercices de tri et de recherche',
                'description' => 'Un fichier par exercice, nommé avec votre matricule.',
                'dateCreation' => now()->subDays(2),
                'dateFermeture' => now()->addDays(7),
                'etat' => 'ouvert',
                'professeur' => 'PROF003',
                'matiere' => 'ALGO',
            ],
            [
                'nomDepot' => 'Étude de cas - Bilan comptable',
                'description' => 'Rendre le bilan complété au format Excel ou PDF.',
                'dateCreation' => now()->subDays(1),
                'dateFermeture' => now()->addDays(14),
                'etat' => 'ouvert',
                'professeur' => 'PROF002',
                'matiere' => 'COMPTA',
            ],
        ];

        foreach ($depots as $depot) {
            DB::table('depots')->insert([
                'nomDepot' => $depot['nomDepot'],
                'description' => $depot['description'],
                'dateCreation' => $depot['dateCreation'],
                'dateFermeture' => $depot['dateFermeture'],
                'delai' => '23:59:00',
                'etat' => $depot['etat'],
                'professeur_id' => DB::table('professeurs')->where('numEmploye', $depot['professeur'])->value('id'),
                'matiere_id' => DB::table('matieres')->where('codeMatiere', $depot['matiere'])->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
