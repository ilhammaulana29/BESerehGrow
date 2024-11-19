<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpc_company_contact extends Model
{
    use HasFactory;

    protected $table = "Cpc_company_contact";

    protected $fillable = [
        'jenis_contact',
        'url_contact'
    ];

    public function company()
    {
        return $this->hasMany(Company::class);
    }
}
