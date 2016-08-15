<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('product_id')->unsigned()->index();
            #$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
            $table->integer('width');
            $table->integer('height');
        });

        Schema::create('vars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('label');
        });

        Schema::create('type_var', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type_id')->unsigned()->index();
            #$table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types');
            $table->integer('var_id')->unsigned()->index();
            #$table->foreign('var_id')->references('id')->on('vars')->onDelete('cascade');
            $table->foreign('var_id')->references('id')->on('vars');
            $table->decimal('price', 5, 2)->nullable();
            $table->integer('quantity')->nullable();
        });

        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
        });


        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('comment');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('type_var_id')->unsigned()->index();
            $table->foreign('type_var_id')->references('id')->on('type_var');
            $table->integer('status_id')->unsigned()->default('1');
            $table->integer('count');
            $table->integer('width');
            $table->integer('height');
            $table->decimal('sum', 5, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    }


    public function down()
    {
        Schema::drop('types');
        Schema::drop('vars');
        Schema::drop('type_var');
        Schema::drop('statuses');
        Schema::drop('orders');
    }
}
