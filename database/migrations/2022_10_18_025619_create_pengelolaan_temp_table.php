<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengelolaanTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengelolaan_temp', function (Blueprint $table) {
            $table->id();
            $table->integer('satker_id');
            $table->year('periode');
            $table->integer('jenis');
            $table->integer('dokumen_id')->nullable();
            $table->integer('kategori_id')->nullable();
            $table->text('form');
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
        Schema::dropIfExists('pengelolaan_temp');
    }
}
