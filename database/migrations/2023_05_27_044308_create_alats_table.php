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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string("nama")->nullable();
            $table->string("kode_alat")->nullable();
            $table->string("foto")->nullable();
            $table->string("stok_jumlah")->nullable();
            $table->timestamp("tanggal_masuk")->nullable();
            $table->foreignId("id_kategori")->nullable();
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
        Schema::dropIfExists('alats');
    }
};
