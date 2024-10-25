<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "cpc_galeri";

    protected $primaryKey = "id_gambar";

    protected $fillable = ["gambar", "kategori", "deskripsi_gambar"];
}
