<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('pesan_layanan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('id_layanan');
        $table->foreign('id_layanan')
              ->references('id_layanan')
              ->on('layanan')
              ->onDelete('cascade');

        $table->string('nama');
        $table->string('asal');
        $table->string('no_hp');
        $table->string('nama_kegiatan');
        $table->string('surat_sph')->nullable();
        $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('pesan_layanan');
    }
};
