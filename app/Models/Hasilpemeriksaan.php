<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hasilpemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pm_hasil_pemeriksaan';
    protected $primaryKey = 'id_hasil_pemeriksaan';

    protected $fillable = [
        'id_pengujian',           // foreign key ke tabel `pm_penyulingan`
        'warna',
        'bau',
        'kelarutan_ethanol',
        'indeks_bias',
        'putaran_optik',
        'kadar_sitronelal',

        
    ];

    // Relasi many-to-one ke Pengujian
    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'id_pengujian', 'id_pengujian');
    }
}
