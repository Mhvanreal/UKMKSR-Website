<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
    {
        // Drop kolom lama
        Schema::table('anggota', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Buat ulang kolom status baru
        Schema::table('anggota', function (Blueprint $table) {
            $table->enum('status', ['Aktif', 'Alumni'])
                ->default('Aktif')
                ->after('tahun_masuk_kuliah');
        });
    }

    public function down()
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('anggota', function (Blueprint $table) {
            $table->enum('status', ['Aktif', 'Inaktif'])
                ->default('Aktif');
        });
    }
};
