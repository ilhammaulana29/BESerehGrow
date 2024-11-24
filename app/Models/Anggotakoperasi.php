<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggotakoperasi extends Model
{
   
    use HasFactory;

    protected $table = 'pc_anggota_koperasi';
    protected $primaryKey = 'id_anggota';

    protected $fillable = [   
        'id_statusanggota',
        'nama_anggota',
        'tgl_bergabung',
        'nik',
        'no_kk',
        'no_hp',
        'tgl_lahir'
    ];

    // Relasi many-to-one ke Penyulingan
    public function statusanggota()
    {
        return $this->belongsTo(Statuskeanggotaan::class, 'id_statusanggota', 'id_statusanggota');
    }
}
