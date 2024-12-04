<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengujian extends Model
{
    use HasFactory;

    protected $table = 'pm_pengujian';
    protected $primaryKey = 'id_pengujian';

    protected $fillable = [
        'id_penyulingan',           // foreign key ke tabel `pm_penyulingan`
        'tgl_diterima',
        'jumlah',
        'kemasan',
        'kode_bahan',
        'sertifikasi',
        'tgl_pemeriksaan',

        
    ];

    // Relasi many-to-one ke Penyulingan
    public function penyulingan()
    {
        return $this->belongsTo(Penyulingan::class, 'id_penyulingan', 'id_penyulingan');
    }
}
