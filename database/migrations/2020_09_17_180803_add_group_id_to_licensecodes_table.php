<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupIdToLicensecodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('licensecodes', function (Blueprint $table) {

          $table->boolean('active')->default(1);;
          $table->unsignedbigInteger('group_id')->nullable();
          $table->foreign('group_id')->references('id')->on('groups')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('licensecodes', function (Blueprint $table) {
          $table->dropColumn('group_id');
        });
    }
}
