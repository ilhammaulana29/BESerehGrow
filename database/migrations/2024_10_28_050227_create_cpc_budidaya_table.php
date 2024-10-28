<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpcBudidayaTable extends Migration
{
    public function up()
    {
        Schema::create('cpc_budidaya', function (Blueprint $table) {
            $table->id();
            $table->string('judul');               // Judul utama
            $table->string('subtitle')->nullable(); // Sub judul
            $table->text('deskripsi');              // Deskripsi utama
            $table->string('image_path')->nullable(); // Path gambar
            $table->text('additional_info')->nullable(); // Info tambahan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cpc_budidaya');
    }
};
