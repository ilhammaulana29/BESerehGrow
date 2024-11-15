<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemupukan extends Model
{
    use HasFactory;

    protected $table = 'cm_pemupukan';
    protected $primaryKey = 'id_pemupukan';
    protected $fillable = [
        'id_blok', 
        'tgl_pemupukan', 
        'jumlah_pupuk', 
        'jenis_pupuk'
    ];

    public function blokLahan()
    {
        return $this->belongsTo(Land::class, 'id_blok', 'id_bloklahan');
    }
}
