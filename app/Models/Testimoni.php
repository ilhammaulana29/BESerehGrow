<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $table = 'cpc_testimoni';

    protected $fillable = ["nama", "gambar", "profesi", "pesan_testimoni"];
}
