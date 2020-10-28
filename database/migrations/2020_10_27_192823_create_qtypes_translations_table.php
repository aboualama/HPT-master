<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQtypesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qtypes_translations', function (Blueprint $table) {
            $table->id();
            $table->biginteger('qtype_id')->unsigned()->nullable();
            $table->string('locale')->index();
            $table->string('title',255)->nullable();
            $table->string('entro',255)->nullable();

            $table->unique(['qtype_id', 'locale']);
            $table->foreign('qtype_id')->references('id')->on('qtypes')->onDelete('cascade');
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
        Schema::dropIfExists('qtypes_translations');
    }
}
