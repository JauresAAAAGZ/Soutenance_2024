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
        Schema::create('depot_filiere', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('depot_id')->nullable();
            $table->foreign('depot_id')->references('id')->on('depots')->onDelete('cascade');

            $table->unsignedBigInteger('filiere_id')->nullable();
            $table->foreign('filiere_id')->references('id')->on('filieres')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depot_filiere');
    }
};
