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
            $table->id();
            $table->unsignedBigInteger('serial')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('code')->comment('Product Code ex: KH-K17');
            $table->integer('amount')->comment('Amount in the stock.');
            $table->integer('price')->comment('Selling Price.');
            $table->integer('cost')->comment('The price of the product when you bought it.');
            $table->string('slug');

            $table->foreignId('bill_id');
            $table->foreignId('brand_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('contribution_id')->constrained();
            $table->foreignId('user_id')->constrained();

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
