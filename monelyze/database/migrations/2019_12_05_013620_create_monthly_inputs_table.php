<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_inputs', function (Blueprint $table) {
            $table->string('user_id', 16);
            $table->date('date');
            $table->integer('take_amount')->nullable();
            $table->integer('target_spending')->nullable();

            $table->primary(['user_id', 'date']);
            $table->foreign('user_id')->references('user_id')->on('accounts');
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
