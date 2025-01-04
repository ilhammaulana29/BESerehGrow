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
            $table->integer('sesi_penyulingan_minggu_bersertifikasi')->after('sesi_penyulingan_minggu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->dropColumn([
                'sesi_penyulingan_minggu_bersertifikasi'
            ]);
        });
    }
};
