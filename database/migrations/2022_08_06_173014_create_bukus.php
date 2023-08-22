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
        Schema::create('bukus', function (Blueprint $table) {
        $table->string('id',32)->primary();
        $table->foreignId('buku_kategori_id')->references('id')->on('kategori_bukus')->nullable();
        $table->integer('is_active')->default('1');
        $table->string('kode_buku')->nullable()->unique();
        $table->string('judul')->nullable();
        $table->string('penerbit')->nullable();
        $table->string('pengarang')->nullable();
        $table->string('halaman')->nullable();
        $table->string('image')->nullable();
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
        //
    }
};
