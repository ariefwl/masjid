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
        Schema::table('shohibuls', function (Blueprint $table) {
            $table->enum('type', ['Sunnah', 'Wajib'])->default('Sunnah')->after('telp');
            $table->string('permintaan', 50)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shohibuls', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('permintaan');
        });
    }
};
