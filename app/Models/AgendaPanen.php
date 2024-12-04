<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaPanen extends Model
{
    use HasFactory;

    protected $table = 'cm_agendapanen';
    protected $primaryKey = 'id_agendapanen';
    protected $fillable = [
        'id_blok',
        'total_panen',
        'total_tanam'
    ];

    public function bloklahan()
    {
        return $this->belongsTo(Land::class, 'id_blok', 'id_bloklahan');
    }
}
