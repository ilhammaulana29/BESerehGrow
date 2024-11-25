<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class AdminAddress extends Model
// {
//     use HasFactory;

//     protected $table = 'admin_addresses'; // Nama tabel
//     protected $primaryKey = 'id_adminaddress'; // Primary key
//     public $timestamps = true; // Gunakan timestamps
//     protected $fillable = [
//         'jalan', 'no_rumah', 'no_rt', 'no_rw',
//         'desa_kelurahan', 'kecamatan', 'kabupaten',
//         'provinsi', 'kode_pos',
//     ]; // Kolom yang dapat diisi

//     // Relasi ke AdminDetail
//     public function adminDetail()
//     {
//         return $this->hasOne(AdminDetail::class, 'id_adminaddress', 'id_adminaddress');
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAddress extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_adminaddress';
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
    public function admin()
{
    return $this->belongsTo(Admin::class, 'id_admin');
}

}

