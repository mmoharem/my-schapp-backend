<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sch_fees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('old_schFees');
            $table->integer('old_booksFees');
            $table->integer('old_totFees');
            $table->integer('schFees')->unsigned()->nullable();
            $table->integer('booksFees')->unsigned()->nullable();
            $table->integer('totFees')->unsigned()->nullable();
            $table->integer('grade_id')->unsigned()->unique()->index()->nullable();
            $table->timestamps();
            $table->foreign('grade_id')->references('id')->on('sh_grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sch_fees');
    }
}
