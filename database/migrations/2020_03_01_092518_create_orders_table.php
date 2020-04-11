<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('last_name', 70)->nullable();
            $table->string('first_name', 70)->nullable();
            $table->string('email', 120)->nullable();
            // $table->unsignedBigInteger('address_id');
            $table->string('state', 120)->nullable();
            $table->string('city', 120)->nullable();
            $table->string('street', 250)->nullable();
            $table->string('house', 5)->nullable();
            $table->string('flat', 120)->nullable();
            $table->string('postal_code', 6)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->float('price')->nullable();
            $table->string('status', 25)->default('Корзина');
            $table->timestamps();

            // $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
