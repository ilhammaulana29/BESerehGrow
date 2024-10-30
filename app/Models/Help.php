<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $table = "cpc_bantuan";

    protected $primaryKey = "id_bantuan";

    protected $fillable = ["pertanyaan", "jawaban"];
}