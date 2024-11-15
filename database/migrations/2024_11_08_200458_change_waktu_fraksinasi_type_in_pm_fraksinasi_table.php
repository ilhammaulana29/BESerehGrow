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
            // Ubah tipe data kolom waktu_fraksinasi dari time menjadi float
            $table->float('waktu_fraksinasi')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pm_fraksinasi', function (Blueprint $table) {
            // Kembalikan tipe data kolom waktu_fraksinasi ke tipe time
            $table->time('waktu_fraksinasi')->change();
        });
    }
};
