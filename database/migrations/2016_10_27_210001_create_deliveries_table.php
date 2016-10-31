<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{

    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->index();
            $table->string('name');
            $table->string('phone');
            $table->string('city');
            $table->string('warehouses');
        });


    }

    public function down()
    {
        Schema::drop('deliveries');
    }

}
