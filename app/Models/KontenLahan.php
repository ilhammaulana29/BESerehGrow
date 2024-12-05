<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenLahan extends Model
{
    protected $table = 'cpc_lahan';
    protected $fillable = ["judul", "sub_judul", "isi_konten", "gambar"];
}