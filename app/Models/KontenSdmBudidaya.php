<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontenSdmBudidaya extends Model
{
    protected $table = 'cpc_sdm_budidaya';
    protected $fillable = ["judul", "sub_judul", "isi_konten", "gambar"];
}
