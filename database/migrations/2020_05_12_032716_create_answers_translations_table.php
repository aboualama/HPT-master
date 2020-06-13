<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('answer')->nullable();

            $table->string('locale')->index();
            $table->biginteger('answer_id')->unsigned();
            $table->unique(['answer_id', 'locale']);
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers_translations');
    }
}
