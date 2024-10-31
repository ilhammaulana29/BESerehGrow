<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'pm_keluhan';

    // Kolom yang boleh diisi (fillable)
    protected $fillable = [
        'tgl_pengaduan',
        'keluhan',
        'jumlah_kasus',
        'nama_pengadu',
        'alamat_pengadu',
        'bukti_aduan',
        'tindak_lanjut',
    ];

    // Jika primary key bukan 'id'
    protected $primaryKey = 'id_keluhan';
}
    //