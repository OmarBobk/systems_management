<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->integer('net_price');
            $table->integer('cost');
            $table->integer('amount');
            $table->integer('total');
            $table->integer('profit');
            $table->text('description')->nullable();
            $table->string('type')->default('retail')->comment('Wholesale|Retail|Units|Invoice|Other');
            $table->boolean('is_debt')->default(false);

            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('saletype_id')->constrained();
            $table->foreignId('contribution_id')->constrained();

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
        Schema::dropIfExists('sales');
    }
}
