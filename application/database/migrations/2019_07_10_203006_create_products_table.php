<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('code',10)->nullale(false);
            $table->string('name',120)->nullable(false);
            $table->string('bar_code',100)->nullable();
            $table->text('description')->nullable();
            $table->float('price_unit')->nullable(false);
            $table->float('price_cost')->nullable(false);
            $table->string('avatar',100)->nullable();
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
