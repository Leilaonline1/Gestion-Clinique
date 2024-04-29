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
            $table->string('categorie')->nullable()->after('valeur_max');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valeurs_normales', function (Blueprint $table) {
            $table->dropColumn('categorie');
        });
    }
};
