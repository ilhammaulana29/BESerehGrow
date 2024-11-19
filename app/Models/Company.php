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
        'slogan'
    ];

    protected $primaryKey = 'id_company';

}
