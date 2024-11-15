<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmAreaRindang extends Model
{
    use HasFactory;

    protected $table = 'cm_arearindang';
    
    protected $primaryKey = 'id_arearindang';

    protected $fillable = [
        'id_blok',
        'jumlah_rumpun',
        'luas'
    ];

    // Define relationship with CmBloklahan
    public function bloklahan()
    {
        return $this->belongsTo(Land::class, 'id_bloklahan');
    }
}
