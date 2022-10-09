<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_productsection', function (Blueprint $table) {
            $table->id();

            $table->foreignId('productsection_id')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('product_id')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('product_productsection');
    }
};
