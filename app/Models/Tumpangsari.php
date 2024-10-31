<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tumpangsari extends Model
{
    use HasFactory;

    protected $table = 'cm_tumpangsari';
    protected $primaryKey = 'id_tumpangsari';
    protected $fillable = [
        'id_blok', 
        'jenis_tanaman', 
        'jumlah_tanaman', 
        'tinggi_tanaman'
    ];

    public function blokLahan()
    {
        return $this->belongsTo(Land::class, 'id_blok', 'id_bloklahan');
    }
}
