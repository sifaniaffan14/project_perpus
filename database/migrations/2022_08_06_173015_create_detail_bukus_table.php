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
        Schema::create('detail_bukus', function (Blueprint $table) {
            $table->string('eksemplar_id',16)->primary();
            $table->string('buku_id',32)->nullable();
            $table->foreign('buku_id')->references('id')->on('bukus');
            $table->string('no_panggil')->nullable()->unique();
            $table->string('status')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('barcode')->nullable();
            $table->integer('is_active')->default('1');
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
        Schema::dropIfExists('detail_bukus');
    }
};
