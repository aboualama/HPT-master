<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        //   $table->string('name')->nullable();
        $table->string('userName')->nullable();
        $table->string('displayName')->nullable();
        $table->string('referentName')->nullable();
        $table->string('referentNumber')->nullable();
        $table->string('lastName')->nullable();
        $table->string('cell')->nullable();
        $table->string('cf')->nullable();
        $table->string('address')->nullable();
        $table->string('company')->nullable();
        $table->string('role')->nullable();
        $table->boolean('isTermsConditionAccepted')->default(true);
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
