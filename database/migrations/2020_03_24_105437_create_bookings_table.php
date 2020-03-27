<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id('id_booking');
            $table->integer('kd_booking');
            $table->integer('id_paket');
            $table->integer('id_customer');
            $table->integer('id_keberangkatan');
            $table->integer('nomor_tiket');
            $table->integer('nomor_kamar');
            $table->dateTime('tgl_booking');
            $table->boolean('aktif');
            $table->dateTime('tgl_batal');
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
        Schema::dropIfExists('booking');
    }
}
