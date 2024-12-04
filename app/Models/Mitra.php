<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table = "cpc_mitra";

    protected $fillable = [
        'gambar',
        'nama',
        'deskripsi_gambar'
    ];

    protected $primaryKey = 'id_mitra';
}
