<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kategori_id')->unsigned();
            $table->bigInteger('curr_id')->unsigned();
            $table->bigInteger('unit_id')->unsigned();
            $table->string('nama_produk');
            $table->float('harga_jual');
            $table->float('harga_beli');
            $table->string('disc');
            $table->integer('stok')->unsigned();
            $table->string('barcode');
            $table->string('status');
            $table->string('print_label')->nullable();
            $table->string('diskon')->nullable();
            $table->text('keterangan');
            $table->string('untung')->nullable();
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
        Schema::dropIfExists('products');
    }
}
