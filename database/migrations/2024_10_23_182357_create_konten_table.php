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
        // Tabel CompanyAddress
        Schema::create('company_address', function (Blueprint $table) {
            $table->id('id_cpaddress'); // Ensure this is the primary key
            $table->string('jalan');
            $table->string('rt');
            $table->string('rw');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            $table->timestamps();
        });

        // Tabel CpcCompanyContact
        Schema::create('cpc_company_contact', function (Blueprint $table) {
            $table->id('id_cpcontact');
            $table->string('jenis_contact');
            $table->string('url_contact');
            $table->timestamps();
        });

        // Tabel CpcAbout
        Schema::create('cpc_about', function (Blueprint $table) {
            $table->id('id_aboutcp');
            $table->string('gambar_perusahaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->text('latar_belakang')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->timestamps();
        });

        // Tabel CpcCompanyHistory
        Schema::create('cpc_company_history', function (Blueprint $table) {
            $table->id('id_cphistory');
            $table->string('judul');
            $table->string('sub_judul');
            $table->text('deskripsi');
            $table->timestamps();
        });


        // Tabel CpcKonten
        Schema::create('cpc_konten', function (Blueprint $table) {
            $table->id('id_konten');
            $table->string('nama_penulis');
            $table->unsignedBigInteger('id_jenis_konten'); // Kolom foreign key
            $table->foreign('id_jenis_konten')->references('id_jenis_konten')->on('jenis_konten')->onDelete('cascade');            $table->string('judul_konten');
            $table->text('deskripsi_konten');
            $table->string('gambar')->nullable();
            $table->string('video')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        // Tabel CpcCompany
        Schema::create('cpc_company', function (Blueprint $table) {
            $table->id('id_company');
            $table->string('nama_company');
            $table->string('logo_company')->nullable();
            $table->string('slogan')->nullable();
            $table->timestamps();
        });

        // Tabel CpcMitra
        Schema::create('cpc_mitra', function (Blueprint $table) {
            $table->id('id_mitra');
            $table->string('gambar');
            $table->string('nama');
            $table->text('deskripsi_gambar')->nullable();
            $table->timestamps();
        });

        // Tabel CpcBantuan
        Schema::create('cpc_bantuan', function (Blueprint $table) {
            $table->id('id_bantuan');
            $table->text('pertanyaan');
            $table->text('jawaban');
            $table->timestamps();
        });

        // Tabel CpcTestimoni
        Schema::create('cpc_testimoni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gambar');
            $table->string('profesi');
            $table->text('pesan_testimoni');
            $table->timestamps();
        });

        // Tabel CpcGaleri
        // Tabel CpcGaleri
        Schema::create('cpc_galeri', function (Blueprint $table) {
            $table->id('id_galeri');
            $table->string('gambar')->nullable();
            $table->unsignedBigInteger('id_kategori'); // Kolom foreign key
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
            $table->text('deskripsi_gambar')->nullable();
            $table->timestamps();
        });


        // Tabel CpcLandingPage
        Schema::create('cpc_landing_page', function (Blueprint $table) {
            $table->id('id_landingpage');
            $table->string('header');
            $table->text('isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpc_landing_page');
        Schema::dropIfExists('cpc_galeri');
        Schema::dropIfExists('cpc_testimoni');
        Schema::dropIfExists('cpc_bantuan');
        Schema::dropIfExists('cpc_mitra');
        Schema::dropIfExists('cpc_company');
        Schema::dropIfExists('company_address');
        Schema::dropIfExists('cpc_konten');
        Schema::dropIfExists('cpc_company_contact');
        Schema::dropIfExists('cpc_company_history');
        Schema::dropIfExists('cpc_about');
        Schema::dropIfExists('cpc_penulis');
    }
};
