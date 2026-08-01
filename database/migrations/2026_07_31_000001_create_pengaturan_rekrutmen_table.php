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
        Schema::create('pengaturan_rekrutmen', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_open')->default(false);
            $table->string('pesan_tutup')->nullable();
            $table->timestamp('tanggal_buka')->nullable();
            $table->timestamp('tanggal_tutup')->nullable();
            $table->timestamps();
        });

        // Insert default record
        DB::table('pengaturan_rekrutmen')->insert([
            'is_open' => false,
            'pesan_tutup' => 'Pendaftaran anggota baru sedang ditutup. Silakan tunggu informasi selanjutnya.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_rekrutmen');
    }
};
