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
        // Tabel pm_stok
        Schema::create('pm_stok', function (Blueprint $table) {
            $table->id('id_stok');
            $table->foreignId('id_pengemasan')->constrained('pm_pengemasan', 'id_pengemasan')->onDelete('cascade');
            $table->decimal('jumlah_tersedia', 10, 2);
            $table->string('lokasi_gudang', 150);
            $table->enum('status_stok', ['Tersedia', 'Keluar'])->default('Tersedia');
            $table->timestamps();
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_stok');
    }
};
