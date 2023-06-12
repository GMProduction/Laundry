<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('transaksi_id')->unsigned()->nullable(true);
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
            $table->bigInteger('paket_id')->unsigned();
            $table->foreign('paket_id')->references('id')->on('paket');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('berat');
            $table->integer('total');
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
        Schema::dropIfExists('detail_transaksi');
    }
}
