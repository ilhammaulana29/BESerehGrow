<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fraksinasi extends Model
{
    use HasFactory;

    protected $table = 'pm_fraksinasi';
    protected $primaryKey = 'id_fraksinasi';

    protected $fillable = [
        'no_batch_fraksinasi',
        'id_pengujian',           // foreign key ke tabel `pm_penyulingan`
        'tgl_fraksinasi',
        'volume_minyak_awal',
        'volume_minyak_akhir',
        'waktu_fraksinasi',
        'kadar_sitronelal',
        'kadar_geraniol',
        'suhu_pemisah',
        'tekanan_vakum',
    ];
}
