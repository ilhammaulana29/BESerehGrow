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
        Schema::create('karyawan_address', function (Blueprint $table) {
            $table->id('id_karyawanaddress');
            $table->string('jalan');
            $table->string('no_rumah');
            $table->string('no_rt');
            $table->string('no_rw');
            $table->string('desa_kelurahan');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->timestamps();
        });

        // Creating Karyawan table
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->unsignedBigInteger('id_karyawanaddress'); // Foreign key to KaryawanAddress table
            $table->string('nama_lengkap');
            $table->string('pekerjaan');
            $table->decimal('upah_harian', 8, 2);
            $table->decimal('gaji_pokok', 10, 2);
            $table->timestamps();

            // Foreign key relationship
            $table->foreign('id_karyawanaddress')
                    ->references('id_karyawanaddress')
                    ->on('karyawan_address')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
        // Drop KaryawanAddress table
        Schema::dropIfExists('karyawan_address');
    }
};
