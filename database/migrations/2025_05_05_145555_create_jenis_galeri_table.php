<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jenis_galeri', function (Blueprint $table) {
            $table->id('id_jenis_galeri');
            $table->string('nama_jenis_galeri');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jenis_galeri');
    }
    
};
