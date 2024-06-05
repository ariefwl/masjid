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
        Schema::table('hewans', function(Blueprint $table){
            $table->renameColumn('id_kelompok', 'id_jenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hewans', function(Blueprint $table){
            $table->renameColumn('id_jenis', 'id_kelompok');
        });
    }
};
