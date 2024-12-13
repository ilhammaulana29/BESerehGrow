<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kalkulasilahan extends Model
{
    use HasFactory;

    protected $table = 'la_kalkulasi_lahan';
    protected $primaryKey = 'id_kalkulasi';

    protected $fillable = [
        'id_parameter',
        'kode_laporan_analisis',
        'tgl_buat',
        'luas_lahan',
        'kapasitas_penyulingan',
        'luas_per_blok',
        'jumlah_rumpun_per_blok',
        'sesi_penyulingan_minggu',
        'sesi_penyulingan_minggu_bersertifikasi',
        'produksi_daun_per_minggu',
        'produksi_daun_per_minggu_bersertifikasi',
        'produksi_daun_per_hari',
        'produksi_daun_per_hari_bersertifikasi',
        'hasil_minyak',
        'hasil_minyak_bersertifikasi',
        'produksi_minyak_bersertifikasi',
        'produksi_minyak_per_minggu',
        'pendapatan_bawah_30',
        'pendapatan_atas_30',
    ];

    // Relasi many-to-one ke Penyulingan
    public function parameterkalkulasi()
    {
        return $this->belongsTo(Parameterkalkulasi::class, 'id_parameter', 'id_parameter');
    }
}
