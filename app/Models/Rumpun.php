<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumpun extends Model
{
    use HasFactory;

    protected $table = 'cm_rumpun'; // Database table
    protected $primaryKey = 'id_rumpun';
    
    protected $fillable = [
        'nama_blok',
        'id_blok',
        'jenis_rumpun',
        'lebar_rumpun',
        'tinggi_rumpun',
        'warna_daun',
        'lebar_daun',
        'tekstur_daun'
    ];
    public function blokLahan()
    {
        return $this->belongsTo(Land::class, 'id_blok', 'id_bloklahan');
    }
}
