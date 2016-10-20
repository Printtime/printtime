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

        Schema::create('postpress_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('postpress_id')->unsigned();
            $table->foreign('postpress_id')->references('id')->on('postpress');
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
