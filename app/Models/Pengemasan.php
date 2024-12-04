<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengemasan extends Model
{
    use HasFactory;

    protected $table = 'pm_pengemasan';
    protected $primaryKey = 'id_pengemasan';

    protected $fillable = [
        'id_pengujian',           // foreign key ke tabel `pm_penyulingan`
        'jenis_kemasan',
        'kode_kemasan',
        'kapasitas_kemasan',
        'jumlah_kemasan',
        'tgl_pengemasan',
        'status_pengemasan',

        
    ];

    // Relasi many-to-one ke Penyulingan
    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'id_pengujian', 'id_pengujian');
    }
}
