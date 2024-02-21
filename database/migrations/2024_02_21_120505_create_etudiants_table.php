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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id('matricule');
            $table->string('nomEtudiant');
            $table->string('prenomEtudiant');
            $table->string('emailEtudiant')->unique();
            $table->unsignedBigInteger('filiere_id')->nullable();
            $table->foreign('filiere_id')->references('idFiliere')->on('filieres')->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pswdEtudiant');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
