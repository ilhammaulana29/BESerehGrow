<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyulingan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'pm_penyulingan';
    protected $primaryKey = 'id_penyulingan';

    protected $fillable = [
        'no_batch_penyulingan',
        'tgl_penyulingan',
        'berat_daun',
        'waktu_penyulingan',
        'banyak_minyak',
        'bahan_bakar',
        'suhu_pembakaran',
        'air_rebusan',
        'penyebaran_asap',
        'status',
    ];
   
    public function pengujians()
    {
        return $this->hasMany(Pengujian::class, 'id_penyulingan', 'id_penyulingan');
    }
}
