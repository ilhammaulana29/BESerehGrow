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
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->renameColumn('sesi_panen_per_blok', 'sesi_penyulingan_minggu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->renameColumn('sesi_penyulingan_minggu', 'sesi_panen_per_blok');
        });
    }
};
