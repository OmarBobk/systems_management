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
        Schema::create('invoicerecords', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Electric, Gaz, Water...');

            $table->integer('serial');
            $table->integer('cost');
            $table->integer('price')->comment('price - cost = profit');
            $table->integer('profit');

            $table->foreignId('invoice_id')->constrained();
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
        Schema::dropIfExists('invoicerecords');
    }
};
