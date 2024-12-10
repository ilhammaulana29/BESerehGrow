<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'id_adminpmnt',
        'email',
        'password',
    ];

    // Relasi ke AdminAddress
    public function adminAddress()
    {
        return $this->hasOne(AdminAddress::class, 'id_adminaddress', 'id_admin');
    }

    // Relasi ke AdminDetail
    public function adminDetail()
    {
        return $this->hasOne(AdminDetail::class, 'id_admin', 'id_admin');
    }

    public function adminPermit()
    {
        return $this->hasOne(AdminPermit::class, 'id_adminpmnt', 'id_adminpmnt');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];

}
}