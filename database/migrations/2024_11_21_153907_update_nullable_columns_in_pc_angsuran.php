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
        Schema::table('pc_angsuran', function (Blueprint $table) {
            // Ubah kolom-kolom agar nullable
            $table->date('tgl_angsur')->nullable()->change();
            $table->float('besar_angsuran')->nullable()->change();
            $table->string('status_angsuran')->nullable()->change();
            $table->string('keterangan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pc_angsuran', function (Blueprint $table) {
            // Balik perubahan ke kondisi awal
            $table->date('tgl_angsur')->nullable(false)->change();
            $table->float('besar_angsuran')->nullable(false)->change();
            $table->string('status_angsuran')->nullable(false)->change();
            $table->string('keterangan')->nullable(false)->change();
        });
    }
};
