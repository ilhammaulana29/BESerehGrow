<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenPerawatan extends Model
{
    protected $table = 'cpc_perawatan';
    protected $fillable = ["judul", "sub_judul", "isi_konten", "gambar"];
}