<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisRumpunTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_rumpun', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('jenis_rumpun')->unique(); // Jenis Rumpun field
            $table->timestamps(); // Created at and Updated at fields
        });
    }

    public function down()
    {
        Schema::dropIfExists('jenis_rumpun');
    }
}
