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
        // Ubah nama kolom `no_batchpenyulingan` menjadi `no_batch_penyulingan` pada tabel `pm_penyulingan`
        Schema::table('pm_penyulingan', function (Blueprint $table) {
            $table->renameColumn('no_batchpenyulingan', 'no_batch_penyulingan');
            $table->float('waktu_penyulingan')->change(); // Ubah tipe data waktu_penyulingan menjadi float
            $table->string('status')->nullable(); // Tambahkan kolom status
        });

        // Ubah nama kolom `no_batchpengujian` menjadi `no_batch_pengujian` pada tabel `pm_pengujian`
        Schema::table('pm_pengujian', function (Blueprint $table) {
            $table->renameColumn('no_batchpengujian', 'no_batch_pengujian');
        });

        // Ubah nama kolom `no_batchpengemasan` menjadi `no_batch_penyulingan` pada tabel `pm_pengemasan`
        Schema::table('pm_fraksinasi', function (Blueprint $table) {
            $table->renameColumn('no_batchfraksinasi', 'no_batch_fraksinasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan perubahan jika migration di-rollback
        Schema::table('pm_penyulingan', function (Blueprint $table) {
            $table->renameColumn('no_batch_penyulingan', 'no_batchpenyulingan');
            $table->time('waktu_penyulingan')->change(); // Kembalikan tipe data ke time
            $table->dropColumn('status'); // Hapus kolom status
        });

        Schema::table('pm_pengujian', function (Blueprint $table) {
            $table->renameColumn('no_batch_pengujian', 'no_batchpengujian');
        });

        Schema::table('pm_pengemasan', function (Blueprint $table) {
            $table->renameColumn('no_batch_penyulingan', 'no_batchpengemasan');
        });
    }
};
