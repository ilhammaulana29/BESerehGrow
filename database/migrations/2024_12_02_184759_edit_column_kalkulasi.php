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
        // Ubah tipe data pada tabel la_kalkulasi_lahan
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->integer('pendapatan_bawah_30')->change(); // Ubah menjadi integer
            $table->integer('pendapatan_atas_30')->change(); // Ubah menjadi integer
        });

        // Ubah tipe data pada tabel la_parameter_kalkulasi
        Schema::table('la_parameter_kalkulasi', function (Blueprint $table) {
            $table->integer('harga_minyak_bawah_30')->change(); // Ubah menjadi integer
            $table->integer('harga_minyak_atas_30')->change(); // Ubah menjadi integer
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // Kembalikan tipe data ke decimal pada tabel la_kalkulasi_lahan
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->decimal('pendapatan_bawah_30', 15, 2)->change(); // Kembalikan ke decimal
            $table->decimal('pendapatan_atas_30', 15, 2)->change(); // Kembalikan ke decimal
        });

    // Kembalikan tipe data ke decimal pada tabel la_parameter_kalkulasi
        Schema::table('la_parameter_kalkulasi', function (Blueprint $table) {
            $table->decimal('harga_minyak_bawah_30', 15, 2)->change(); // Kembalikan ke decimal
            $table->decimal('harga_minyak_atas_30', 15, 2)->change(); // Kembalikan ke decimal
        });
    }
};
