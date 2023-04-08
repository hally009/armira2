<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanRakbmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_rakbm', function (Blueprint $table) {
            $table->id();
            $table->integer('pengadaan_id');
            $table->integer('produk_id');
            $table->integer('sbsk_bmn');
            $table->integer('existing_bmn');
            $table->integer('kebutuhan');
            $table->integer('total');
            $table->integer('peluang_setuju');
            $table->integer('uapb')->nullable();
            $table->integer('apip')->nullable();
            $table->integer('status')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('pengadaan_rakbm');
    }
}
