<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->text('description')->nullable();
            $table->date('deposit_date')->default(\Carbon\Carbon::now());
            $table->date('due_date');
            $table->integer('profits_percent');
            $table->tinyInteger('status')->default(0)->comment('0: working, 1: returned');
            $table->date('returned_date')->nullable();

            $table->foreignId('contributor_id')->constrained();
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
        Schema::dropIfExists('contributions');
    }
}
