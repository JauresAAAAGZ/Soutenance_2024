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
        Schema::create('professeurs', function (Blueprint $table) {
            $table->id('numEmploye');
            $table->string('nomProfesseur');
            $table->string('prenomProfesseur');
            $table->string('emailProfesseur')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('pswdProfesseur');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professeurs');
    }
};
