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
        // Tabel CmBloklahan
        Schema::create('cm_bloklahan', function (Blueprint $table) {
            $table->id('id_bloklahan');
            // Removed foreign key for id_rumpun
            $table->string('namablok');
            $table->decimal('luasblok', 8, 2);
            $table->integer('jumlah_rumpun');
            $table->decimal('totalproduksidaun', 8, 2);
            $table->decimal('jarak_tanam', 8, 2);
            $table->decimal('kemiringan', 5, 2);
            $table->string('unsurhara');
            $table->string('jenis_rumpun'); // Add enum column
            $table->timestamps();
        });

        // Tabel CmRumpun
        Schema::create('cm_rumpun', function (Blueprint $table) {
            $table->id('id_rumpun');
            $table->foreignId('id_blok')->constrained('cm_bloklahan', 'id_bloklahan')->onDelete('cascade');
            $table->string('nama_blok');
            $table->string('jenis_rumpun');
            $table->decimal('lebar_rumpun', 8, 2);
            $table->decimal('tinggi_rumpun', 8, 2);
            $table->string('warna_daun');
            $table->decimal('lebar_daun', 8, 2);
            $table->string('tekstur_daun');
            $table->timestamps();
        });

        // Tabel CmPanen
        Schema::create('cm_panen', function (Blueprint $table) {
            $table->id('id_panen');
            $table->foreignId('id_blok')->constrained('cm_bloklahan', 'id_bloklahan')->onDelete('cascade');
            $table->string('nama_blok');
            $table->date('tgl_panen');
            $table->decimal('berat_daun', 8);
            $table->decimal('jumlah_ikat', 8);
            $table->decimal('total_berat_daun', 8);
            $table->timestamps();
        });
        // Tabel CmPenyulaman
        Schema::create('cm_penyulaman', function (Blueprint $table) {
            $table->id('id_sulam');
            $table->foreignId('id_blok')->constrained('cm_bloklahan', 'id_bloklahan')->onDelete('cascade');
            $table->integer('jml_rumpun');
            $table->date('tgl_penyulaman');
            $table->timestamps();
        });

        // Tabel CmPemupukan
        Schema::create('cm_pemupukan', function (Blueprint $table) {
            $table->id('id_pemupukan');
            $table->foreignId('id_blok')->constrained('cm_bloklahan', 'id_bloklahan')->onDelete('cascade');
            $table->date('tgl_pemupukan');
            $table->decimal('jumlah_pupuk', 8, 2);
            $table->string('jenis_pupuk');
            $table->timestamps();
        });

        // Tabel CmTumpangsari
        Schema::create('cm_tumpangsari', function (Blueprint $table) {
            $table->id('id_tumpangsari');
            $table->foreignId('id_blok')->constrained('cm_bloklahan', 'id_bloklahan')->onDelete('cascade');
            $table->string('jenis_tanaman');
            $table->integer('jumlah_tanaman');
            $table->decimal('tinggi_tanaman', 8, 2);
            $table->timestamps();
        });

        // Tabel CmAreaRindang
        Schema::create('cm_arearindang', function (Blueprint $table) {
            $table->id('id_arearindang');
            $table->foreignId('id_blok')->constrained('cm_bloklahan', 'id_bloklahan')->onDelete('cascade');
            $table->integer('jumlah_rumpun');
            $table->decimal('luas', 8, 2);
            $table->timestamps();
        });

        // Tabel CmAgendaPanen
        Schema::create('cm_agendapanen', function (Blueprint $table) {
            $table->id('id_agendapanen');
            $table->decimal('total_panen', 8, 2);
            $table->decimal('total_tanam', 8, 2);
            $table->timestamps();
        });

        // Tabel CmPlasma
        Schema::create('cm_plasma', function (Blueprint $table) {
            $table->id('id_plasma');
            $table->string('nama_petani');
            $table->decimal('berat_daun', 8, 2);
            $table->string('jenis_rumpun');
            $table->decimal('total_harga', 12, 2);
            $table->date('tgl_setor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus semua tabel
        Schema::dropIfExists('cm_plasma');
        Schema::dropIfExists('cm_agendapanen');
        Schema::dropIfExists('cm_arearindang');
        Schema::dropIfExists('cm_tumpangsari');
        Schema::dropIfExists('cm_pemupukan');
        Schema::dropIfExists('cm_penyulaman');
        Schema::dropIfExists('cm_bloklahan');
        Schema::dropIfExists('cm_rumpun');
    }
};
