<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produk');
            $table->integer('qty');
            $table->bigInteger('user_id');
            $table->bigInteger('harga');
            $table->bigInteger('bayar');
            $table->bigInteger('kembalian');
            $table->string('metode_pembayaran');
            $table->string('barcode');
            $table->string('kasir');
            $table->string('no_ref');
            $table->string('tanggal');
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
        Schema::dropIfExists('transactions');
    }
}
