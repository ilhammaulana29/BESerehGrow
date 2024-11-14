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
        Schema::table('pm_fraksinasi', function (Blueprint $table) {
            // Menghapus kolom id_penyulingan dan constraint foreign key-nya jika ada
            $table->dropForeign(['id_penyulingan']); // Hapus foreign key
            $table->dropColumn('id_penyulingan');    // Hapus kolom
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pm_fraksinasi', function (Blueprint $table) {
            // Menambahkan kembali kolom id_penyulingan dengan foreign key
            $table->foreignId('id_penyulingan')->constrained('pm_penyulingan', 'id_penyulingan')->onDelete('cascade');
        });
    }
};
