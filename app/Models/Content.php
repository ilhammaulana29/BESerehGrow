<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'cpc_konten';

    protected $primaryKey = "id_konten";

    protected $fillable = ["nama_penulis", "id_jenis_konten", "judul_konten", "deskripsi_konten", "gambar", "video", "slug"];
}
