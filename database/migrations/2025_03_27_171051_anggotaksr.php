<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->unique();
            $table->string('email')->nullable();
            $table->string('nama')->nullable();
            $table->string('Nama_panggilan')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('Agama')->nullable();
            $table->longText('alasan_join')->nullable();
            $table->Integer('angkatan')->nullable();
            $table->string('foto')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('prodi')->nullable();
            $table->string('Gol_darah')->nullable();
            $table->string('No_tlpn')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif', 'Inaktif']);
            $table->year('tahun_masuk_kuliah')->nullable();
            $table->text('organisasi_yg_pernah_diikuti')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        //
    }
};
