<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostpressData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postpress_data', function ($table) {
            $table->increments('id');
            $table->integer('postpress_id')->unsigned()->index();
            $table->foreign('postpress_id')->references('id')->on('postpress');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postpress_data');
    }
}
