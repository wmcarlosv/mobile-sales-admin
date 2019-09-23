<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->integer('qty')->nullable()->defaul(1);
            $table->float('price_unit')->nullable()->default(0.0);
            $table->float('total_line')->nullable()->default(0.0);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('restrict')->onDelete('restrict');

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
