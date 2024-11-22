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
        Schema::table('cpc_company_contact', function (Blueprint $table) {
            // Ubah nama kolom
            $table->renameColumn('jenis_contact', 'jenis_kontak');
            $table->renameColumn('url_contact', 'url_kontak');

            // Hapus sifat unik
            $table->dropUnique(['jenis_contact']);
            $table->dropUnique(['url_contact']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cpc_company_contact', function (Blueprint $table) {
            // Kembalikan nama kolom ke semula
            $table->renameColumn('jenis_kontak', 'jenis_contact');
            $table->renameColumn('url_kontak', 'url_contact');

            // Tambahkan kembali sifat unik
            $table->unique('jenis_contact');
            $table->unique('url_contact');
        });
    }
};
