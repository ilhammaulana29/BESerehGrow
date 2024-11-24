<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpc_company_history extends Model
{
    use HasFactory;

    protected $table = "Cpc_company_history";

    protected $fillable = [
        'judul',
        'sub_judul',
        'deskripsi'
    ];

    public function company()
    {
        return $this->hasMany(Company::class);
    }

    protected $primaryKey = 'id_cphistory';
}
