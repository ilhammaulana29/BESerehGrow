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
        // Tabel LaAnalisislahan
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
            $table->timestamps();
        });

        // Tabel LaProsedur
        Schema::create('la_prosedur', function (Blueprint $table) {
            $table->id('id_prosedur');
            $table->string('jenis_konten');
            $table->string('judul');
            $table->string('gambar')->nullable();
            $table->text('deskripsi');
            $table->timestamps();
        });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Menghapus tabel LaAnalisislahan dan LaProsedur
    Schema::dropIfExists('la_prosedur');
    Schema::dropIfExists('la_analisislahan');
    }
};
