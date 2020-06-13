<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedbigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');

            $table->float('value_1')->nullable();
            $table->float('value_2')->nullable();
            $table->float('value_3')->nullable();
            $table->float('value_4')->nullable();
            $table->float('value_5')->nullable();
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
        Schema::dropIfExists('answers');
    }
}
