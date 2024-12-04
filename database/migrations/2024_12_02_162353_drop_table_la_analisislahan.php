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
        Schema::dropIfExists('la_analisislahan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('la_analisislahan', function (Blueprint $table) {
            $table->id('id_analisislahan');
            $table->decimal('luas_lahan', 8, 2);
            $table->integer('jumlah_blok');
            $table->decimal('luas_blok', 8, 2);
            $table->integer('jumlah_rumpun');
            $table->decimal('produksi_daun', 8, 2);
            $table->integer('sesi_panen');
            $table->decimal('kapasitas_penyulingan', 8, 2);
            $table->integer('sesi_penyulingan');
            $table->decimal('hasil_minyak', 8, 2);
            $table->string('kode_laporan')->after('id_analisislahan')->unique();
            $table->date('tgl_buat')->after('hasil_minyak');
            $table->timestamps();
        });
    }
};
