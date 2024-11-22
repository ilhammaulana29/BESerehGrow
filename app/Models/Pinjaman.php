<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pc_pinjaman';
    protected $primaryKey = 'id_pinjaman';

    protected $fillable = [
        'id_anggota',      
        'tgl_pinjam',
        'besar_pinjam',
        'bunga_berjalan',
        'sesi_angsuran',
        'keterangan_pinjaman',
        'status_pinjam',
    ];

    // Relasi many-to-one ke Penyulingan
    public function anggota()
    {
        return $this->belongsTo(Anggotakoperasi::class, 'id_anggota', 'id_anggota');
    }

}
