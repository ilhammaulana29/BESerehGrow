<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budidaya extends Model
{
    use HasFactory;

    protected $table = 'cpc_budidaya';

    protected $fillable = [
        'judul',
        'subtitle',
        'deskripsi',
        'gambar',
        'additionalinfo',
    ];
}
