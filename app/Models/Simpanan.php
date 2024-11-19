<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;

    protected $table = 'pc_simpanan';
    protected $primaryKey = 'id_simpanan';

    protected $fillable = [
        'id_anggota',      
        'id_jenissimpanan',
        'tgl_simpan',
        'jml_simpan',
        'keterangan'
    ];

    // Relasi many-to-one ke Penyulingan
    public function anggota()
    {
        return $this->belongsTo(Anggotakoperasi::class, 'id_anggota', 'id_anggota');
    }
    public function jenissimpanan()
    {
        return $this->belongsTo(Jenissimpanan::class, 'id_jenissimpanan', 'id_jenissimpanan');
    }

}
