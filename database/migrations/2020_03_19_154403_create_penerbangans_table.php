<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerbangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Penerbangan', function (Blueprint $table) {
            $table->id('id_penerbangan');
            $table->string('kode_penerbangan', 50);
            $table->string('nama_penerbangan', 100);
            $table->boolean('aktif');
            $table->string('keterangan', 255);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Penerbangan');
    }
}
