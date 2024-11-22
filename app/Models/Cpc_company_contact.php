<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cpc_company_contact extends Model
{
    protected $table = 'Cpc_company_contact'; // Nama tabel
    protected $primaryKey = 'id_cpcontact';   // Kolom primary key
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'jenis_contact',
        'url_contact',
    ];
}
