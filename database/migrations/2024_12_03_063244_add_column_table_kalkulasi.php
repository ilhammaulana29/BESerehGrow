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
            $table->integer('sesi_panen_per_minggu')->after('harga_minyak_atas_30')->nullable();
        });

        // Menambahkan kolom di tabel la_kalkulasi_lahan
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->decimal('produksi_daun_per_hari', 10, 2)->after('produksi_daun_per_minggu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Menghapus kolom dari tabel la_parameter_kalkulasi
        Schema::table('la_parameter_kalkulasi', function (Blueprint $table) {
            $table->dropColumn('sesi_panen_per_minggu');
        });

        // Menghapus kolom dari tabel la_kalkulasi_lahan
        Schema::table('la_kalkulasi_lahan', function (Blueprint $table) {
            $table->dropColumn('produksi_daun_per_hari');
        });
    }
};
