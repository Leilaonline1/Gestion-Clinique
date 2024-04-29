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
        Schema::table('valeurs_normales', function (Blueprint $table) {
            $table->string('valeur', 20, 2)->change(); // Changer le type de la colonne valeur en décimal avec 2 chiffres après la virgule
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valeurs_normales', function (Blueprint $table) {
            $table->text('valeur')->change(); // Revertir le type de la colonne valeur en text
        });
    }
};
