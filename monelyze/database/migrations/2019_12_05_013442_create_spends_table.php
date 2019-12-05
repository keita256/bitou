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
            $table->string('user_id', 16);
            $table->date('date');
            $table->integer('number');
            $table->string('expense_id', 32);
            $table->string('content', 255)->nullable();
            $table->integer('amount');
            $table->primary(['user_id', 'date', 'number']);
            $table->foreign('user_id')->references('user_id')->on('accounts');
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
