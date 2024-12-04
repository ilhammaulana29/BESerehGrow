<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenPenyulingan extends Model
{
    protected $table = 'cpc_penyulingan';
    protected $fillable = ["judul", "sub_judul", "isi_konten", "gambar"];
}