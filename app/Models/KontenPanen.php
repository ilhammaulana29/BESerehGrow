<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenPanen extends Model
{
    protected $table = 'cpc_masa_panen';
    protected $fillable = ["judul", "sub_judul", "isi_konten", "gambar"];
}