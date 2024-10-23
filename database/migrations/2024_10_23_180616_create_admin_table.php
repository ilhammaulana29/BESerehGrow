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
       // Tabel AdminPermit
        Schema::create('admin_permits', function (Blueprint $table) {
            $table->id('id_adminpmnt');  // menggunakan nama kolom 'id_adminpmnt' sebagai PK
            $table->string('permitacces');
            $table->timestamps();
        });

        // Tabel Admin
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');  // id utama tabel admins
            $table->unsignedBigInteger('id_adminpmnt');  // tambahkan unsignedBigInteger
            $table->foreign('id_adminpmnt')->references('id_adminpmnt')->on('admin_permits')->cascadeOnDelete();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Tabel AdminAddress
        Schema::create('admin_addresses', function (Blueprint $table) {
            $table->id('id_adminaddress');
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

        // Tabel AdminDetail
        Schema::create('admin_details', function (Blueprint $table) {
            $table->id('id_admindetail');
            $table->unsignedBigInteger('id_admin');  // tambahkan unsignedBigInteger
            $table->unsignedBigInteger('id_adminaddress');  // tambahkan unsignedBigInteger
            $table->foreign('id_admin')->references('id_admin')->on('admins')->cascadeOnDelete();  // foreign key ke admins
            $table->foreign('id_adminaddress')->references('id_adminaddress')->on('admin_addresses')->cascadeOnDelete();  // foreign key ke admin_addresses
            $table->string('nama_lengkap');
            $table->string('nohp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus tabel dengan urutan yang berlawanan
        Schema::dropIfExists('admin_details');
        Schema::dropIfExists('admin_addresses');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('admin_permits');
    }
};
