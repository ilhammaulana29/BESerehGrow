<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenissimpanan extends Model
{
    use HasFactory;

    protected $table = 'pc_jenis_simpanan';
    protected $primaryKey = 'id_jenissimpanan';

    protected $fillable = [
        'nama_simpanan',           
        'deskripsi'
    ];
}

