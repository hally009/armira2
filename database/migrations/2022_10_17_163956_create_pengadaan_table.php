<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->id();
            $table->integer('satker_id');
            $table->year('periode');
            $table->string('nama');
            $table->string('kode_transaksi');
            $table->integer('kepada');
            $table->integer('pengadaan_id')->nullable();
            $table->integer('status_progress')->default(0);
            $table->integer('status_apip')->default(0);
            $table->integer('status_pengesahan')->nullable();
            $table->text('file')->nullable();
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
        Schema::dropIfExists('pengadaan');
    }
}
