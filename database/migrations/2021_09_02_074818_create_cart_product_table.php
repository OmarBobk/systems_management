<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_product', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->integer('net_price');
            $table->integer('net_cost');

            $table->foreignId('cart_id')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('product_id')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
//
//            $table->integer('user_id')->unsigned()->index();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->integer('role_id')->unsigned()->index();
//            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

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
        Schema::dropIfExists('cart_product');
    }
}
