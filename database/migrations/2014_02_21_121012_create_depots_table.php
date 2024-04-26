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
        Schema::create('depots', function (Blueprint $table) {
            $table->id();
            $table->string('nomDepot');
            $table->dateTime('dateCreation');
            $table->dateTime('dateFermeture');
            $table->time('delai');
            $table->string('description');
            $table->string('etat')->default('ouvert');
            $table->unsignedBigInteger('professeur_id')->nullable();
            $table->foreign('professeur_id')->references('id')->on('professeurs')->onDelete('cascade');
            $table->unsignedBigInteger('matiere_id')->nullable();
            $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depots');
    }
};
