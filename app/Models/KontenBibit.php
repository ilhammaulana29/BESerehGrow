<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenBibit extends Model
{
    protected $table = 'cpc_pemilihan_bibit';
    protected $fillable = ["judul", "sub_judul", "isi_konten", "gambar"];
}