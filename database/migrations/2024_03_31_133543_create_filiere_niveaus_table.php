<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('filiere_niveaus', function (Blueprint $table) {
            $table->unsignedBigInteger('filiere_id')->nullable();
            $table->foreign('filiere_id')->references('idFiliere')->on('filieres')->onDelete('cascade');


            $table->unsignedBigInteger('niveau_id')->nullable();
            $table->foreign('niveau_id')->references('idNiveau')->on('niveaux')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filiere_niveaus');
    }
};
