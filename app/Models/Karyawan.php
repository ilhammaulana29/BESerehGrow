<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';

    protected $fillable = [
        'id_karyawanaddress',
        'nama_lengkap',
        'pekerjaan',
        'upah_harian',
        'gaji_pokok',
    ];

    public function address()
    {
        return $this->belongsTo(KaryawanAddress::class, 'id_karyawanaddress', 'id_karyawanaddress');
    }
}
