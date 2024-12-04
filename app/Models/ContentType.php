<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $table = 'jenis_konten';

    protected $primaryKey = "id_jenis_konten";

    protected $fillable = ["jenis_konten"];
}
