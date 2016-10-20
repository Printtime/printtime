<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostpressProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('users', function ($table) {
            $table->decimal('balance', 8, 2)->default('0.00')->change();
        });

        Schema::table('type_var', function ($table) {
            $table->decimal('price', 8, 2)->nullable()->change();
        });
        Schema::table('orders', function ($table) {
            $table->decimal('sum', 8, 2)->nullable()->change();
        });
         
        Schema::create('postpress_product', function (Blueprint $table) {
            $table->integer('postpress_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->primary(['postpress_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postpress_product');
    }
}
