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
            $table->string('rang')->after('valeur')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('valeurs_normales', function (Blueprint $table) {
            $table->dropColumn('rang');
        });
    }
};
