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
        Schema::table('la_parameter_kalkulasi', function (Blueprint $table) {
            $table->integer('jumlah_batang_daun')->after('harga_minyak_atas_30');
            $table->integer('jumlah_batang_daun_sertifikasi')->after('jumlah_batang_daun');
            $table->decimal('berat_rumpun', 10, 2)->after('jumlah_batang_daun_sertifikasi');
            $table->decimal('berat_rumpun_sertifikasi', 10, 2)->after('berat_rumpun');
        });

        // Menambahkan kolom pada tabel la_kalkulasi_lahan
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->integer('produksi_daun_per_minggu_bersertifikasi')->after('produksi_daun_per_minggu');
            $table->integer('produksi_daun_per_hari_bersertifikasi')->after('produksi_daun_per_minggu_bersertifikasi');
            $table->decimal('hasil_minyak_bersertifikasi', 10, 2)->after('hasil_minyak');
            $table->decimal('produksi_minyak_bersertifikasi', 10, 2)->after('produksi_minyak_per_minggu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('la_parameter_kalkulasi', function (Blueprint $table) {
            $table->dropColumn([
                'jumlah_batang_daun', 
                'jumlah_batang_daun_sertifikasi', 
                'berat_rumpun', 
                'berat_rumpun_sertifikasi'
            ]);
        });

        // Menghapus kolom dari tabel la_kalkulasi_lahan
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->dropColumn([
                'produksi_daun_per_minggu_bersertifikasi', 
                'produksi_daun_per_hari_bersertifikasi', 
                'hasil_minyak_bersertifikasi', 
                'produksi_minyak_bersertifikasi'
            ]);
        });
    }
};
