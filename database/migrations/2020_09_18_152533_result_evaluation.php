<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ResultEvaluation extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('result_evaultation', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('type')->unique();
      $table->text('point')->nullable();
      $table->json('video')->nullable();
      $table->text('extra')->nullable();
    });
    DB::table('result_evaultation')->insert(
      array(
         ['type' => 'Recognation', 'point' => '', 'video' => '{}',],
         ['type' => 'Reaction-SMC', 'point' => '', 'video' => '{}',],
         ['type' => 'Hazard-Perception', 'point' => '', 'video' => '{}',],
         ['type' => 'Risk-Responsibilty', 'point' => '', 'video' => '{}',],
         ['type' => 'Reaction-simple', 'point' => '', 'video' => '{}',],
         ['type' => 'Reaction-complex', 'point' => '', 'video' => '{}',],
      )
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('result_evaultation');
  }
}
