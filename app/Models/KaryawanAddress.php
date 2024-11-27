<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanAddress extends Model
{
    use HasFactory;

    protected $table = 'karyawan_address';
    protected $primaryKey = 'id_karyawanaddress';

    protected $fillable = [
        'jalan',
        'no_rumah',
        'no_rt',
        'no_rw',
        'desa_kelurahan',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
    ];

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'id_karyawanaddress', 'id_karyawanaddress');
    }
}
