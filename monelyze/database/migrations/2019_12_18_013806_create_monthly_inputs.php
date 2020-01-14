<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyInputs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_inputs', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();;
            $table->integer('year');
            $table->integer('month');
            $table->integer('take_amount')->nullable();
            $table->integer('target_spending')->nullable();
            $table->primary(['user_id', 'year', 'month']);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_inputs');
    }
}
