<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpc_about extends Model
{
    use HasFactory;

    protected $table = "cpc_about";

    protected $fillable = [
        'gambar_perusahaan',
        'nama_perusahaan',
        'latar_belakang',
        'visi',
        'misi',
    ];

    protected $primaryKey = "id_aboutcp";
}
