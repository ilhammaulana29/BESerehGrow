<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plasma extends Model
{
    use HasFactory;

    protected $table = 'cm_plasma';

    protected $fillable = [
        'nama_petani',
        'berat_daun',
        'jenis_rumpun',
        'total_harga',
        'tgl_setor',
    ];
}
