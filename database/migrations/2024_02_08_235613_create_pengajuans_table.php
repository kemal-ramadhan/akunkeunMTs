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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_versi');
            $table->foreignId('id_guru');
            $table->string('nama_pengajuan');
            $table->string('jenis_pengajuan');
            $table->string('keterangan');
            $table->integer('nominal');
            $table->integer('nominal_diberi');
            $table->date('tanggal_pengajuan');
            $table->string('status_bag_keuangan');
            $table->string('status_bag_kamad');
            $table->string('catatan');
            $table->string('status_pengajuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
