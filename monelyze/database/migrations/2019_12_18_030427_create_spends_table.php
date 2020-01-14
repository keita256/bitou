<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spends', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->date('date');
            $table->integer('number');
            $table->integer('expense_id')->unsigned();
            $table->string('content', 255)->nullable();
            $table->integer('amount');
            $table->primary(['user_id', 'date', 'number']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('expense_id')->references('expense_id')->on('expenses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spends');
    }
}
