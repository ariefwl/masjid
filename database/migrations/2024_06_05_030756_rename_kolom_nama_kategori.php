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
        Schema::table('jenis', function(Blueprint $table){
            $table->renameColumn('nama_kategori', 'nama_jenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jenis', function(Blueprint $table){
            $table->renameColumn('nama_jenis', 'nama_kategori');
        });
    }
};
