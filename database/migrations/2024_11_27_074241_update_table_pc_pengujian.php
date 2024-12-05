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
        Schema::table('pm_pengujian', function (Blueprint $table) {
            // Menghapus kolom lama
            $table->dropColumn(['no_batch_pengujian', 'tgl_pengujian', 'rendemen_atsiri', 'kadar_sitronelal', 'kadar_geraniol','status']);
            
            // Menambahkan kolom baru
            $table->date('tgl_diterima')->after('id_penyulingan');
            $table->float('jumlah')->after('tgl_diterima'); // Sesuaikan tipe data sesuai kebutuhan
            $table->float('kemasan')->after('jumlah');
            $table->string('kode_bahan')->after('kemasan');
            $table->string('sertifikasi')->nullable()->after('kode_bahan');
            $table->date('tgl_pemeriksaan')->after('sertifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pm_pengujian', function (Blueprint $table) {
            // Menambahkan kembali kolom yang dihapus
            $table->string('no_batch_pengujian')->unique()->after('id_penyulingan');
            $table->date('tgl_pengujian')->after('no_batch_pengujian');
            $table->float('rendemen_atsiri')->after('tgl_pengujian');
            $table->float('kadar_sitronelal')->after('rendemen_atsiri');
            $table->float('kadar_geraniol')->after('kadar_sitronelal');
            $table->string('status');
            
            // Menghapus kolom baru
            $table->dropColumn(['tgl_diterima', 'jumlah', 'kemasan', 'kode_bahan', 'sertifikasi', 'tgl_pemeriksaan']);
        });
    }
};
