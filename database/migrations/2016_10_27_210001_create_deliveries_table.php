<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('user_id')->unsigned()->index();
            $table->string('name');
            $table->string('phone');
            $table->string('city');
            $table->string('cityref');
            $table->string('address');
            $table->integer('number');
        });

        DB::table('deliveries')->insert([
            'type' => 'printtime',
            'name' => 'Самовывоз со склада Printtime',
        ]);


        Schema::table('orders', function ($table) {
            $table->integer('delivery_id')->default('1');
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function ($table) {
            $table->dropColumn('delivery_id');
        });

        Schema::drop('deliveries');
    }


}
