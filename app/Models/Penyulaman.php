<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyulaman extends Model
{
    use HasFactory;

    protected $table = 'cm_penyulaman'; // Nama tabel di database
    protected $primaryKey = 'id_sulam';

    protected $fillable = [
        'id_blok',         // Foreign key untuk blok lahan
        'tgl_penyulaman',  // Tanggal penyulaman
        'jml_rumpun'       // Jumlah rumpun yang ditanam
    ];

    // Jika ada relasi dengan blok lahan
    public function blokLahan()
    {
        return $this->belongsTo(Land::class, 'id_bloklahan');
    }
}
