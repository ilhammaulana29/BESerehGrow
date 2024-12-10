<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = "cpc_company";

    protected $fillable = [
        'nama_company',
        'logo_company',
        'slogan',
    ];

    protected $primaryKey = 'id_company';

    // Accessor for logo URL
    // public function getLogoUrlAttribute()
    // {
    //     return $this->logo_company 
    //         ? asset('storage/logo/' . $this->logo_company) 
    //         : null;
    // }
}
