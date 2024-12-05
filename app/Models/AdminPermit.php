<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPermit extends Model
{
    use HasFactory;

    protected $table = 'admin_permits'; // Nama tabel
    protected $primaryKey = 'id_adminpmnt'; // Primary key
    public $timestamps = true; // Gunakan timestamps
    protected $fillable = ['permitacces']; // Kolom yang dapat diisi

    // Relasi ke Admin
    public function admins()
    {
        return $this->hasMany(Admin::class, 'id_adminpmnt', 'id_adminpmnt');
    }
}
