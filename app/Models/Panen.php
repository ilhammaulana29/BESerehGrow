<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $table = 'cm_panen';

    protected $fillable = [
        'id_blok',
        'nama_blok',
        'tgl_panen',
        'berat_daun',
        'jumlah_ikat',
        'total_berat_daun',
    ];

    public function blokLahan()
    {
        return $this->belongsTo(Land::class, 'id_blok', 'id_bloklahan');
    }
}
