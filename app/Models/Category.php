<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'kategori';

    protected $primaryKey = 'id_kategori';

    // Relasi ke Gallery
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'id_kategori');
    }
}
