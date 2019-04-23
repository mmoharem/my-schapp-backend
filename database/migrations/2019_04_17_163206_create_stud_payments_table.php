<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stud_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_payments');
            $table->integer('tot_paid_fees');
            $table->integer('to_pay_fees')->unsigned()->nullable();
            $table->integer('student_id')->unsigned()->index()->nullable();
            $table->timestamps();
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stud_payments');
    }
}
