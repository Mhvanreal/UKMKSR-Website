<?php
 use Illuminate\Database\Migrations\Migration;
 use Illuminate\Database\Schema\Blueprint;
 use Illuminate\Support\Facades\Schema;

 return new class extends Migration {

public function up(): void
{
    Schema::create('layanan', function (Blueprint $table) {
        $table->engine = 'InnoDB';

        $table->id('id_layanan'); // <-- INI bagian penting
        $table->string('nama_layanan');
        $table->text('deskripsi_layanan')->nullable();
        $table->string('foto_layanan')->nullable();
        $table->string('poster_layanan')->nullable();
        $table->enum('status', ['aktif', 'tidak'])->default('tidak');
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
 };
