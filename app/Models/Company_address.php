<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_address extends Model
{
    use HasFactory;

    protected $table = "company_address";

    protected $fillable = [
        'jalan',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos'
    ];

    protected $primaryKey = 'id_cpaddress';

    public function company()
    {
        return $this->hasMany(Company::class);
    }

}
