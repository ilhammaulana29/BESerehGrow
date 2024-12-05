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
       // Tabel la_parameter_kalkulasi
        Schema::create('la_parameter_kalkulasi', function (Blueprint $table) {
            $table->id('id_parameter'); // Primary key
            $table->integer('jumlah_blok');
            $table->decimal('jarak_tanam', 8, 2); // Misal dalam meter
            $table->decimal('harga_minyak_bawah_30', 15, 2); // Harga minyak jika sitronelal <30%
            $table->decimal('harga_minyak_atas_30', 15, 2); // Harga minyak jika sitronelal ≥30%
            $table->timestamps();
        });

    // Tabel la_kalkulasi_lahan
        Schema::create('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->id('id_kalkulasi'); // Primary key
            $table->foreignId('id_parameter')->constrained('la_parameter_kalkulasi','id_parameter')->onDelete('cascade'); // Foreign key
            $table->string('kode_laporan_analisis', 50);
            $table->timestamp('tgl_buat');
            $table->decimal('luas_lahan', 10, 2); // Dalam hektar
            $table->integer('kapasitas_penyulingan'); // Dalam kg
            $table->decimal('luas_per_blok', 10, 2); // Dalam hektar
            $table->integer('jumlah_rumpun_per_blok');
            $table->integer('sesi_panen_per_blok');
            $table->decimal('produksi_daun_per_minggu', 10, 2); // Dalam ton
            $table->decimal('hasil_minyak', 10, 2); // Dalam liter
            $table->decimal('produksi_minyak_per_minggu', 10, 2); // Dalam liter
            $table->decimal('pendapatan_bawah_30', 15, 2); // Pendapatan jika sitronelal <30%
            $table->decimal('pendapatan_atas_30', 15, 2); // Pendapatan jika sitronelal ≥30%
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('la_kalkulasi_lahan');
        Schema::dropIfExists('la_parameter_kalkulasi');
    }
};
