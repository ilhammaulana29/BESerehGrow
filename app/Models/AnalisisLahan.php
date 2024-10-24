<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisLahan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'la_analisislahan';

    // Kolom yang boleh diisi (fillable)
    protected $fillable = [
        'luas_lahan',
        'jumlah_blok',
        'luas_blok',
        'jumlah_rumpun',
        'produksi_daun',
        'sesi_panen',
        'kapasitas_penyulingan',
        'sesi_penyulingan',
        'hasil_minyak',
    ];

    // Jika primary key bukan 'id'
    protected $primaryKey = 'id_analisislahan';
}
