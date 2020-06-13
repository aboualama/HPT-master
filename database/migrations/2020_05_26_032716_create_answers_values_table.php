<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_values', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->float('value_1')->nullable();
            $table->float('value_2')->nullable();
            $table->float('value_3')->nullable();
            $table->float('value_4')->nullable();
            $table->float('value_5')->nullable();

            $table->unsignedbigInteger('answer_id');
            $table->foreign('answer_id')->references('id')->on('answers')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('answers_values');
    }
}
