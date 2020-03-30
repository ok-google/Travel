<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_detail', function (Blueprint $table) {
            $table->id('id_paket_detail');
            $table->integer('id_paket');
            $table->integer('id_keberangkatan');
            $table->integer('id_keberangkatan');
            $table->boolean('aktif');
            $table->string('keterangan');
            ;
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_detail');
    }
}
