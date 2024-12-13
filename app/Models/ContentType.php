<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $table = 'jenis_konten';

    protected $primaryKey = "id_jenis_konten";


    // Relasi ke Content
    public function contents()
    {
        return $this->hasMany(Content::class, 'id_jenis_konten');
    }
}
