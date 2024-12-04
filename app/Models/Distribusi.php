<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Distribusi extends Model
{
    use HasFactory;

    protected $table = 'pm_distribusi';
    protected $primaryKey = 'id_distribusi';

    protected $fillable = [
        'id_pengemasan',           // foreign key ke tabel `pm_penyulingan`
        'tujuan_distribusi',
        'jumlah_dikirim',
        'tgl_pengiriman',
        'status_pengiriman',
    ];

    // Relasi many-to-one ke Penyulingan
    public function pengemasan()
    {
        return $this->belongsTo(Pengemasan::class, 'id_pengemasan', 'id_pengemasan');
    }
}
