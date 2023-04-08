<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengelolaanAlurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengelolaan_alur', function (Blueprint $table) {
            $table->id();
            $table->integer('pengelolaan_id');
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
        Schema::dropIfExists('pengelolaan_alur');
    }
}
