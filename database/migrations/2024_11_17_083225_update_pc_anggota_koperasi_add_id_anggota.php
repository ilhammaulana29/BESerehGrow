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
       // Menghapus foreign key dan kolom id_anggotaalamat di tabel pc_anggota_koperasi
        Schema::table('pc_anggota_koperasi', function (Blueprint $table) {
        // Menghapus foreign key
        $table->dropForeign(['id_alamatanggota']);
        // Menghapus kolom id_anggotaalamat
        $table->dropColumn('id_alamatanggota');
        });

        // Menambahkan kolom id_anggota sebagai foreign key di tabel pc_alamat_anggota
        Schema::table('pc_alamat_anggota', function (Blueprint $table) {
            // Menambahkan kolom id_anggota sebagai foreign key
            $table->foreignId('id_anggota')
                ->constrained('pc_anggota_koperasi', 'id_anggota')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       // Membalikkan perubahan jika migrasi di-rollback

        // Menambahkan kembali kolom id_anggotaalamat ke tabel pc_anggota_koperasi
        Schema::table('pc_anggota_koperasi', function (Blueprint $table) {
            // Menambahkan kolom id_anggotaalamat
            $table->foreignId('id_anggotaalamat')
                ->constrained('pc_alamat_anggota', 'id_alamatanggota')
                ->onDelete('cascade');
        });

        // Menghapus foreign key dan kolom id_anggota dari tabel pc_alamat_anggota
        Schema::table('pc_alamat_anggota', function (Blueprint $table) {
            // Menghapus foreign key
            $table->dropForeign(['id_anggota']);
            // Menghapus kolom id_anggota
            $table->dropColumn('id_anggota');
        });
    }
};
