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
        Schema::create('detail_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengeluaran');
            $table->foreignId('id_dompet');
            $table->foreignId('id_guru');
            $table->foreignId('id_pengajuan');
            $table->foreignId('id_kakeibo');
            $table->string('nama_pengeluaran');
            $table->string('atas_nama');
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->integer('total');
            $table->date('tanggal_pengeluaran');
            $table->string('keterangan');
            $table->string('bukti_foto');
            $table->string('bukti_pembelian');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengeluarans');
    }
};
