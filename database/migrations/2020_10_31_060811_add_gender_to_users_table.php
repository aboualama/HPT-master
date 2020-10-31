<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userss', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('birthDate')->nullable();
            $table->string('tipoPatente')->nullable();
            $table->year('driveYear')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userss', function (Blueprint $table) {
            //
        });
    }
}
