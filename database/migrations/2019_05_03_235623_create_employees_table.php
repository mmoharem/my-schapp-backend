<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profession');
            $table->integer('insurance_state');
            $table->date('reg_date');
            $table->longText('experience');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->integer('salary_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('salary_id')->references('id')->on('salaries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
