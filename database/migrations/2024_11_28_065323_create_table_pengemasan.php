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
        Schema::create('pm_pengemasan', function (Blueprint $table) {
            $table->id('id_pengemasan');
            $table->foreignId('id_pengujian')->constrained('pm_pengujian', 'id_pengujian')->onDelete('cascade'); // Pastikan pm_pengujian ada dan kolom id menggunakan tipe data yang sesuai
            $table->string('jenis_kemasan', 100);
            $table->string('kode_kemasan', 50)->unique();
            $table->decimal('kapasitas_kemasan', 8, 2); // Contoh: kapasitas botol dalam liter atau ml
            $table->integer('jumlah_kemasan'); // Jumlah kemasan yang diproduksi
            $table->date('tgl_pengemasan'); // Tanggal kemasan dibuat
            $table->enum('status_pengemasan', ['Tersedia', 'Terjual', 'Dalam Proses'])->default('Dalam Proses');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_pengemasan');
    }
};
