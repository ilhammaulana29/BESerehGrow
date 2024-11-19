<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpc_about extends Model
{
    use HasFactory;

    protected $table = "cpc_about";

    protected $fillable = [
        'visi',
        'misi',
        'kebijakan',
        'ketentuan'
    ];

    protected $primaryKey = "id_aboutcp";
    public function company()
    {
        return $this->hasMany(Company::class);
    }
}
