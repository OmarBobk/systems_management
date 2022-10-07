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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('The field name');
            $table->string('value')->comment('The field value');
            $table->string('type')->comment('The field type: price, color, size');
            $table->text('additional')->default('{}')->comment('additional attributes will be a json key:value data.');
            $table->integer('order')->comment('not always will be needed');

            $table->unsignedBigInteger('attributeable_id');
            $table->string('attributeable_type');
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
        Schema::dropIfExists('attributes');
    }
};
