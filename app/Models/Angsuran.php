<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'pc_angsuran';
    protected $primaryKey = 'id_angsuran';

    protected $fillable = [
        'id_pinjaman',      
        'bulan_angsur',
        'tgl_angsur',
        'besar_angsuran',
        'keterangan',
        'status_angsuran',
    ];

    // Relasi many-to-one ke Penyulingan
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'id_pinjaman', 'id_pinjaman');
    }
}
