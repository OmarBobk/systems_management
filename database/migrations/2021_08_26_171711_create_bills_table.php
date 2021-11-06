<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('goods');
            $table->integer('amount')->comment('The cost of the bill');
            $table->text('description')->comment('make clear which currency did meant in amount field');
            $table->integer('quantity')->comment('The total of items');
            $table->integer('serial')->unique()->comment('Bill Serial Number');
            $table->foreignId('seller_id')->constrained();
            $table->foreignId('contribution_id')->constrained();
//            $table->foreignId('image_id')->constrained();
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
        Schema::dropIfExists('bills');
    }
}
