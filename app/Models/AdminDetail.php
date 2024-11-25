<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class AdminDetail extends Model
// {
//     use HasFactory;

//     protected $table = 'admin_details'; // Nama tabel
//     protected $primaryKey = 'id_admindetail'; // Primary key
//     public $timestamps = true; // Gunakan timestamps
//     protected $fillable = ['id_admin', 'id_adminaddress', 'nama_lengkap', 'nohp']; // Kolom yang dapat diisi

//     // Relasi ke Admin
//     public function admin()
//     {
//         return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
//     }

//     // Relasi ke AdminAddress
//     public function adminAddress()
//     {
//         return $this->belongsTo(AdminAddress::class, 'id_adminaddress', 'id_adminaddress');
//     }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'id_admin',
        'id_adminaddress',
        'nama_lengkap',
        'nohp',
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    // Relasi ke AdminAddress
    public function adminAddress()
    {
        return $this->belongsTo(AdminAddress::class, 'id_adminaddress');
    }

}
