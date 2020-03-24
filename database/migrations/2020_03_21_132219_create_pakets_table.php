<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id("id_paket");
            $table->integer("id_penerbangan");
            $table->integer("id_hotel");
            $table->integer("id_kamar");
            $table->string("nama_paket", 100);
            $table->decimal("harga", 20, 2);
            $table->integer("durasi");
            $table->boolean("aktif");
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
        Schema::dropIfExists('paket');
    }
}
