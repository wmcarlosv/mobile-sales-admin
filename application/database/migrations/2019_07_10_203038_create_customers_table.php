<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dni',30)->nullable(false);
            $table->string('full_name',200)->nullable(false);
            $table->string('email',150)->nullable(false);
            $table->string('phone',25)->nullable(false);
            $table->string('city',150)->nullable(false);
            $table->string('address',255)->nullable(false);
            $table->text('note')->nullable();
            $table->string('seller_code',8)->nullable();
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('customers');
    }
}
