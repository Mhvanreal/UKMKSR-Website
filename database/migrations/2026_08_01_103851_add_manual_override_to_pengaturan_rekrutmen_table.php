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
        Schema::table('pengaturan_rekrutmen', function (Blueprint $table) {
            $table->boolean('manual_override')->default(false)->after('is_auto')
                ->comment('True jika admin manual override status (jangan auto-check)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaturan_rekrutmen', function (Blueprint $table) {
            $table->dropColumn('manual_override');
        });
    }
};
