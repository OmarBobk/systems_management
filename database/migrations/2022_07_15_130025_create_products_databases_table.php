<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_databases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serial')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('code')->comment('Product Code ex: KH-K17');
            $table->string('slug');
            $table->string('image_url')->nullable();

            $table->foreignId('brand_id')->constrained();
            $table->foreignId('category_id')->constrained();
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
        Schema::dropIfExists('products_databases');
    }
}
