<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->text('content');
            $table->string('avatar')->nullable();
            $table->text('photo')->nullable();
            $table->integer('catalog_id')->unsigned()->nullable();
            $table->timestamps();
        });


        // Schema::create('product_catalog', function (Blueprint $table) {
        //     $table->integer('catalog_id')->unsigned();
        //     $table->integer('product_id')->unsigned();
        //     $table->primary(['catalog_id', 'product_id']);
        // });



    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products');
        #Schema::drop('product_catalog');
    }
}
