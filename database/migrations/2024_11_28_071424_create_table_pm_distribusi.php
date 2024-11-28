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
    { // Tabel pm_distribusi
        Schema::create('pm_distribusi', function (Blueprint $table) {
            $table->id('id_distribusi');
            $table->foreignId('id_pengemasan')->constrained('pm_pengemasan', 'id_pengemasan')->onDelete('cascade');
            $table->string('tujuan_distribusi', 200);
            $table->integer('jumlah_dikirim');
            $table->date('tgl_pengiriman');
            $table->enum('status_pengiriman', ['Dikirim', 'Terkirim'])->default('Dikirim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_distribusi');
    }
};
