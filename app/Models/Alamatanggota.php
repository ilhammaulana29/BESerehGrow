<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamatanggota extends Model
{
    use HasFactory;

    protected $table = 'pc_alamat_anggota';
    protected $primaryKey = 'id_alamatanggota';
    public $incrementing = true; // Mengaktifkan auto increment
    protected $keyType = 'int'; // Pastikan tipe data sesuai dengan database

    protected $fillable = [
        'jalan',           
        'no_rumah',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'id_anggota'
    ];
    public function anggota()
    {
        return $this->belongsTo(Anggotakoperasi::class, 'id_anggota', 'id_anggota');
    }

}
