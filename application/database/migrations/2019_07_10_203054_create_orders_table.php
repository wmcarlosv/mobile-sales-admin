<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_numer',10)->nullable(false);
            $table->date('order_date')->nullable(false);
            $table->bigInteger('customer_id')->unsigned();
            $table->string('sellder_code',4)->nullable();
            $table->text('note')->nullable();
            $table->float('tax')->nullable()->default(0.0);
            $table->float('discount')->nullable()->default(0.0);
            $table->float('transport')->nullable()->default(0.0);
            $table->float('total')->nullable()->default(0.0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
