<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Le délai se déduit de dateFermeture, et une colonne TIME bloquait
     * les dépôts de plus de 34 jours.
     */
    public function up(): void
    {
        Schema::table('depots', function (Blueprint $table) {
            $table->dropColumn('delai');
        });
    }

    public function down(): void
    {
        Schema::table('depots', function (Blueprint $table) {
            $table->time('delai')->nullable();
        });
    }
};
