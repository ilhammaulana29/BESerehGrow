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
        Schema::create('pm_hasil_pemeriksaan', function (Blueprint $table) {
            $table->id('id_hasil_pemeriksaan'); // Primary Key
            $table->foreignId('id_pengujian')->constrained('pm_pengujian', 'id_pengujian')->onDelete('cascade'); // Foreign Key ke tabel pc_pengujian
            $table->string('warna', 50); // Hasil pemeriksaan warna
            $table->string('bau', 50); // Hasil pemeriksaan bau
            $table->string('kelarutan_ethanol', 50); // Hasil kelarutan dalam ethanol
            $table->string('lemak', 50); // Hasil pemeriksaan lemak
            $table->decimal('indeks_bias', 6, 4); // Hasil indeks bias
            $table->decimal('berat_jenis', 6, 4); // Hasil berat jenis
            $table->decimal('putaran_optik', 5, 2); // Hasil putaran optik
            $table->decimal('kadar_sitronelal', 5, 2); // Kadar sitronelal (GC)
            $table->timestamps(); // Timestamps created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_hasil_pemeriksaan');
    }
};
