<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('id_kegiatan');

            $table->unsignedBigInteger('id_layanan')->nullable();
            $table->foreign('id_layanan')
                  ->references('id_layanan')
                  ->on('layanan')
                  ->onDelete('set null');

            $table->string('nama_kegiatan');
            $table->text('deskripsi_kegiatan')->nullable();
            $table->string('foto_kegiatan')->nullable();
            $table->string('poster_kegiatan')->nullable();
            $table->enum('status', ['aktif', 'tidak'])->default('tidak');
            $table->date('start_kegiatan')->nullable();
            $table->date('end_kegiatan')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }


};
