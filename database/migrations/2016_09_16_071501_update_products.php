<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function ($table) {
            $table->string('order_name');
            $table->string('order_img');
            $table->integer('order_side');
            $table->integer('order_pos');
            $table->integer('order_vis');
            $table->integer('order_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('order_name');
            $table->dropColumn('order_img');
            $table->dropColumn('order_side');
            $table->dropColumn('order_vis');
            $table->dropColumn('order_group');
        });
    }
}
