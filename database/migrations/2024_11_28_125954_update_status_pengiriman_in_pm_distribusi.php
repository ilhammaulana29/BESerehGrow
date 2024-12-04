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
        Schema::table('pm_distribusi', function (Blueprint $table) {
            // Mengganti enum lama menjadi enum baru
            $table->enum('status_pengiriman', ['Pending', 'Dikirim', 'Selesai'])
                    ->default('Pending')
                    ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pm_distribusi', function (Blueprint $table) {
            // Mengembalikan ke enum lama
            $table->enum('status_pengiriman', ['Dikirim', 'Terkirim'])
                    ->default('Dikirim')
                    ->change();
        });
    }
};
