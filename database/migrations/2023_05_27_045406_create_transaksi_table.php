<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->nullable();
            $table->string('nama_ruangan')->nullable();
            $table->string('nama_barang')->nullable();
            $table->timestamp('tanggal_dipakai')->nullable();
            $table->timestamp('waktu_peminjaman')->nullable();
            $table->date('waktu_peminjaman_ambil')->nullable();
            $table->date('waktu_peminjaman_kembali')->nullable();
            $table->foreignId('id_ruangan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->timestamps();
        });

        Schema::create('pemakaians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->nullable();
            $table->string('nama_ruangan')->nullable();
            $table->string('nama_barang')->nullable();
            $table->timestamp('tanggal_dipakai')->nullable();
            $table->timestamp('waktu_pemakaian')->nullable();
            $table->date('waktu_pemakaian_ambil')->nullable();
            $table->date('waktu_pemakaian_kembali')->nullable();
            $table->foreignId('id_ruangan')->nullable();
            $table->integer('jumlah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemakaians');
        Schema::dropIfExists('peminjaman');
    }
};
