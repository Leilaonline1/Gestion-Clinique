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
        Schema::create('valeurs_normales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('analyse_id')->constrained()->onDelete('cascade');
            $table->decimal('valeur_min', 8, 2); // Valeur minimale avec précision de 8 chiffres et 2 décimales
            $table->decimal('valeur_max', 8, 2); // Valeur maximale avec précision de 8 chiffres et 2 décimales
            // Ajoutez d'autres champs au besoin, tels que le type ou une description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valeurs_normales');
    }
};
