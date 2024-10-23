<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel PcAlamatAnggota
        Schema::create('pc_alamat_anggota', function (Blueprint $table) {
            $table->id('id_alamatanggota');
            $table->string('jalan');
            $table->string('no_rumah');
            $table->string('rt');
            $table->string('rw');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->timestamps();
        });

        // Tabel PcStatusKeanggotaan
        Schema::create('pc_status_keanggotaan', function (Blueprint $table) {
            $table->id('id_statusanggota');
            $table->integer('minimal_keanggotaan');
            $table->string('status');
            $table->string('deskripsi');
            $table->timestamps();
        });

        // Tabel PcJenisSimpanan
        Schema::create('pc_jenis_simpanan', function (Blueprint $table) {
            $table->id('id_jenissimpanan');
            $table->string('nama_simpanan');
            $table->string('deskripsi');
            $table->timestamps();
        });

        // Tabel PcAnggotaKoperasi
        Schema::create('pc_anggota_koperasi', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->foreignId('id_alamatanggota')->constrained('pc_alamat_anggota', 'id_alamatanggota')->onDelete('cascade');
            $table->foreignId('id_statusanggota')->constrained('pc_status_keanggotaan', 'id_statusanggota')->onDelete('cascade');
            $table->string('nama_anggota');
            $table->date('tgl_bergabung');
            $table->string('nik')->unique();
            $table->string('no_kk')->unique();
            $table->string('no_hp');
            $table->date('tgl_lahir');
            $table->timestamps();
        });

        // Tabel PcSimpanan
        Schema::create('pc_simpanan', function (Blueprint $table) {
            $table->id('id_simpanan');
            // Pastikan foreign key merujuk pada kolom id_anggota yang benar
            $table->foreignId('id_anggota')->constrained('pc_anggota_koperasi', 'id_anggota')->onDelete('cascade');
            $table->foreignId('id_jenissimpanan')->constrained('pc_jenis_simpanan', 'id_jenissimpanan')->onDelete('cascade');
            $table->date('tgl_simpan');
            $table->float('jml_simpanan');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel PcPinjaman
        Schema::create('pc_pinjaman', function (Blueprint $table) {
            $table->id('id_pinjaman');
            $table->foreignId('id_anggota')->constrained('pc_anggota_koperasi', 'id_anggota')->onDelete('cascade');
            $table->date('tgl_pinjam');
            $table->float('besar_pinjam');
            $table->float('bunga_berjalan')->default(0);
            $table->integer('sesi_angsuran');
            $table->string('keterangan_pinjaman')->nullable();
            $table->string('status_pinjam');
            $table->timestamps();
        });

        // Tabel PcAngsuran
        Schema::create('pc_angsuran', function (Blueprint $table) {
            $table->id('id_angsuran');
            $table->foreignId('id_pinjaman')->constrained('pc_pinjaman', 'id_pinjaman')->onDelete('cascade');
            $table->integer('bulan_angsur');
            $table->date('tgl_angsur');
            $table->float('besar_angsuran');
            $table->string('status_angsuran');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel PcJenisTransaksi
        Schema::create('pc_jenis_transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('nama_transaksi');
            $table->string('tipe_transaksi');
            $table->string('deskripsi');
            $table->timestamps();
        });

        // Tabel PcKasKoperasi
        Schema::create('pc_kas_koperasi', function (Blueprint $table) {
            $table->id('id_kas');
            $table->foreignId('id_transaksi')->constrained('pc_jenis_transaksi', 'id_transaksi')->onDelete('cascade');
            $table->date('tgl_transaksi');
            $table->float('jumlah_transaksi');
            $table->float('saldo_awal');
            $table->float('saldo_akhir');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        // Tabel PcLaporanKeuangan
        Schema::create('pc_laporan_keuangan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_kas')->constrained('pc_kas_koperasi', 'id_kas')->onDelete('cascade');
            $table->date('tgl_bukabuku');
            $table->date('tgl_tutupbuku');
            $table->float('total_penerimaan');
            $table->float('total_pengeluaran');
            $table->float('saldo_awaltahun');
            $table->float('saldo_akhirtahun');
            $table->string('keterangan_tahun')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pc_laporan_keuangan');
        Schema::dropIfExists('pc_kas_koperasi');
        Schema::dropIfExists('pc_jenis_transaksi');
        Schema::dropIfExists('pc_angsuran');
        Schema::dropIfExists('pc_pinjaman');
        Schema::dropIfExists('pc_simpanan');
        Schema::dropIfExists('pc_anggota_koperasi');
        Schema::dropIfExists('pc_status_keanggotaan');
        Schema::dropIfExists('pc_jenis_simpanan');
        Schema::dropIfExists('pc_alamat_anggota');
    }
};
