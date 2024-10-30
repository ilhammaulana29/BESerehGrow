<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsedurAnalisis extends Model
{
    use HasFactory;
    protected $table = 'la_prosedur';
    protected $primaryKey = 'id_prosedur'; // Menentukan primary key yang tidak standar

    protected $fillable = [
        'jenis_konten',
        'judul',
        'gambar',
        'deskripsi'
    ];
}
