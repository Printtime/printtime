<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Postpress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postpress', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->string('f');
            $table->string('view');
            $table->integer('product_id');
        });

        Schema::create('postpressgables', function ($table) {
            $table->integer('postpress_id');
            $table->integer ('postpressgable_id');
            $table->string('postpressgable_type');
            $table->string('var');
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
        Schema::drop('postpress');
        Schema::drop('postpressgables');
    }
}
