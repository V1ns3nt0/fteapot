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
            $table->unsignedBigInteger('category_id');
            $table->string('name', 100);
            $table->text('card_description');
            $table->text('full_description');
            $table->unsignedBigInteger('tea_kind');
            $table->unsignedBigInteger('tea_taste');
            $table->string('path', 120);
            $table->float('price', 120);
            $table->boolean('actual')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('tea_kind')->references('id')->on('tea_kinds')->onDelete('cascade');
            $table->foreign('tea_taste')->references('id')->on('tea_tastes')->onDelete('cascade');
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
