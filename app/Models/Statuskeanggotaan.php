<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuskeanggotaan extends Model
{
    use HasFactory;

    protected $table = 'pc_status_keanggotaan';
    protected $primaryKey = 'id_statusanggota';

    protected $fillable = [
        'minimal_keanggotaan',           
        'status',
        'deskripsi',
    ];
}
