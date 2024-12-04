<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parameterkalkulasi extends Model
{
    use HasFactory;

    protected $table = 'la_parameter_kalkulasi';
    protected $primaryKey = 'id_parameter';

    protected $fillable = [
        'jumlah_blok',           // foreign key ke tabel `pm_penyulingan`
        'jarak_tanam',
        'sesi_panen_per_minggu',
        'harga_minyak_bawah_30',
        'harga_minyak_atas_30',
    ];
}
