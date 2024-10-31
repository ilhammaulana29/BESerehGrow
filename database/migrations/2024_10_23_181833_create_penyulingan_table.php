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
        // Tabel PmPenyulingan
        Schema::create('pm_penyulingan', function (Blueprint $table) {
            $table->id('id_penyulingan');
            $table->string('no_batchpenyulingan')->unique(); // Tambahkan unique jika ini adalah kunci unik
            $table->date('tgl_penyulingan');
            $table->float('berat_daun');
            $table->time('waktu_penyulingan');
            $table->float('banyak_minyak');
            $table->string('bahan_bakar');
            $table->float('suhu_pembakaran');
            $table->string('air_rebusan');
            $table->string('penyebaran_asap');
            $table->timestamps();
        });

        // Tabel PmPengujian
        Schema::create('pm_pengujian', function (Blueprint $table) {
            $table->id('id_pengujian');
            // Pastikan no_batchpenyulingan di sini merujuk ke id_penyulingan jika Anda ingin membuat hubungan
            $table->foreignId('id_penyulingan')->constrained('pm_penyulingan', 'id_penyulingan')->onDelete('cascade');
            $table->string('no_batchpengujian')->unique(); // Tambahkan unique jika ini adalah kunci unik
            $table->date('tgl_pengujian');
            $table->float('rendemen_atsiri');
            $table->float('kadar_sitronelal');
            $table->float('kadar_geraniol');
            $table->string('status');
            $table->timestamps();
        });

        // Tabel PmFraksinasi
        Schema::create('pm_fraksinasi', function (Blueprint $table) {
            $table->id('id_fraksinasi');
            // Mengubah penamaan untuk konsistensi
            $table->foreignId('id_penyulingan')->constrained('pm_penyulingan', 'id_penyulingan')->onDelete('cascade');
            $table->foreignId('id_pengujian')->constrained('pm_pengujian', 'id_pengujian')->onDelete('cascade');
            $table->string('no_batchfraksinasi')->unique(); // Tambahkan unique jika ini adalah kunci unik
            $table->date('tgl_fraksinasi');
            $table->float('vol_minyakawal');
            $table->float('vol_minyakakhir');
            $table->time('waktu_fraksinasi');
            $table->float('kadar_sitronelal');
            $table->float('kadar_geraniol');
            $table->float('suhu_pemisah');
            $table->float('tekanan_vakum');
            $table->timestamps();
        });

        // Tabel PmKeluhan
        Schema::create('pm_keluhan', function (Blueprint $table) {
            $table->id('id_keluhan');
            $table->date('tgl_pengaduan');
            $table->string('keluhan');
            $table->integer('jumlah_kasus');
            $table->string('nama_pengadu');
            $table->string('alamat_pengadu');
            $table->string('bukti_aduan');
            $table->string('tindak_lanjut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_keluhan');
        Schema::dropIfExists('pm_fraksinasi');
        Schema::dropIfExists('pm_pengujian');
        Schema::dropIfExists('pm_penyulingan');
    }
};
