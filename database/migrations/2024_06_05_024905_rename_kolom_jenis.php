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
        Schema::table('shohibuls', function(Blueprint $table){
            $table->renameColumn('jenis', 'id_hewan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shohibuls', function(Blueprint $table){
            $table->renameColumn('id_hewan', 'jenis');
        });
    }
};
