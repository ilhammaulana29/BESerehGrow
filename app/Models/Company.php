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

    public function company_address()
    {
        return $this->belongsTo(Company_address::class);
    }
    public function cpc_about()
    {
        return $this->belongsTo(Cpc_about::class);
    }

    public function cpc_company_contact()
    {
        return $this->belongsTo(Cpc_company_contact::class);
    }

    public function cpc_company_history()
    {
        return $this->hasMany(Cpc_company_history::class);
    }
}
