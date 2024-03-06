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
        Schema::create('hub_kelas_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa');
            $table->foreignId('id_kelas');
            $table->foreignId('id_versi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hub_kelas_siswas');
    }
};
