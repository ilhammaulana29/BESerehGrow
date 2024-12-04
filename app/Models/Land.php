<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $table = 'cm_bloklahan';

    protected $primaryKey = 'id_bloklahan';

    protected $fillable = [
        'namablok',
        'luasblok',
        'jumlah_rumpun',
        'totalproduksidaun',
        'jarak_tanam',
        'kemiringan',
        'unsurhara',
        'jenis_rumpun'
    ];

    public function panen()
{
    return $this->hasMany(Panen::class, 'id_blok', 'id_bloklahan');
}

public function penyulaman()
{
    return $this->hasMany(Penyulaman::class, 'id_blok', 'id_bloklahan');
}
}
