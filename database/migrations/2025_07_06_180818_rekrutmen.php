<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

     public function up(): void {
        Schema::create('rekrutmen', function (Blueprint $table) {
            $table->id();
            $table->string('No_pendaftaran')->unique();
            $table->string('nim')->unique();
            $table->string('Nama');
            $table->string('Nama_panggilan');
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('Agama')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('prodi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('No_tlpn')->nullable();
            $table->string('Gol_darah')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('organisasi_yg_pernah_diikuti')->nullable();
            $table->year('tahun_masuk_kuliah')->nullable();
            $table->text('alasan_join')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['Belum Diverifikasi', 'Diterima', 'Ditolak'])->default('Belum Diverifikasi');
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
