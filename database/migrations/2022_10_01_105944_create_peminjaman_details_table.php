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
        Schema::create('peminjaman_details', function (Blueprint $table) {
            $table->string('peminjaman_detail_id',32)->primary();
            $table->string('peminjaman_detail_peminjaman_id',32)->nullable();
            $table->foreign('peminjaman_detail_peminjaman_id')->references('peminjaman_id')->on('peminjamen');
            $table->string('detail_buku_id',32)->nullable();
            $table->foreign('detail_buku_id')->references('eksemplar_id')->on('detail_bukus');
            $table->string('status_peminjaman')->nullable();
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali')->nullable();
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
        Schema::dropIfExists('peminjaman_details');
    }
};
