<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Stok extends Model
{
    use HasFactory;

    protected $table = 'pm_stok';
    protected $primaryKey = 'id_stok';

    protected $fillable = [
        'id_pengemasan',           // foreign key ke tabel `pm_penyulingan`
        'jumlah_tersedia',
        'lokasi_gudang',
        'status_stok',
    ];

    // Relasi many-to-one ke Penyulingan
    public function pengemasan()
    {
        return $this->belongsTo(Pengemasan::class, 'id_pengemasan', 'id_pengemasan');
    }
}
