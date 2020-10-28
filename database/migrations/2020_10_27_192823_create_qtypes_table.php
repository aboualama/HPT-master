<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQtypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qtypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['Recognation','Risk-Responsibilty' ,'Reaction-SMC', 'Hazard', 'Hazard-Perception']);
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
        Schema::dropIfExists('qtypes');
    }
}
