<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = "cpc_galeri";

    protected $primaryKey = "id_galeri";

    protected $fillable = ["gambar", "id_kategori", "deskripsi_gambar"];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori');
    }
}