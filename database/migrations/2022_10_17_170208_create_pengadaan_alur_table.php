<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanAlurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_alur', function (Blueprint $table) {
            $table->id();
            $table->integer('pengadaan_id');
            $table->integer('sequence')->default(1);
            $table->integer('status')->default(0);
            $table->date('tanggal_status');
            $table->integer('kepada');
            $table->integer('dari');
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
        Schema::dropIfExists('pengadaan_alur');
    }
}
