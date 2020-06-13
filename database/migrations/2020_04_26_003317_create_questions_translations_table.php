<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_translations', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->text('question')->nullable();
          $table->biginteger('question_id')->unsigned();
          $table->string('locale')->index();
          $table->string('right_answer',255)->nullable();
          $table->string('wrongans_1',255)->nullable();
          $table->string('wrongans_2',255)->nullable();
          $table->string('wrongans_3',255)->nullable();

          $table->string('wrong_answers',255)->nullable();
          $table->string('right_answers',255)->nullable();
          $table->string('img_answers')->nullable();

          $table->unique(['question_id', 'locale']);
          $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

          $table->timestamps();
        });
    }


    /*
    question (id)
    questionin_translate : ("question_id",title,)
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_translations');
    }
}
