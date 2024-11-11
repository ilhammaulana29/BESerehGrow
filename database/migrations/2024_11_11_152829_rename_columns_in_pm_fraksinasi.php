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
            $table->renameColumn('vol_minyakawal', 'volume_minyak_awal');
            $table->renameColumn('vol_minyakakhir', 'volume_minyak_akhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pm_fraksinasi', function (Blueprint $table) {
            $table->renameColumn('volume_minyak_awal', 'vol_minyakawal');
            $table->renameColumn('volume_minyak_akhir', 'vol_minyakakhir');
        });
    }
};
