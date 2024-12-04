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
        Schema::table('la_analisislahan', function (Blueprint $table) {
            $table->string('kode_laporan')->after('id_analisislahan')->unique();
            $table->date('tgl_buat')->after('hasil_minyak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('la_analisislahan', function (Blueprint $table) {
            $table->dropColumn('kode_laporan');
            $table->dropColumn('tgl_buat');
        });
    }
};
