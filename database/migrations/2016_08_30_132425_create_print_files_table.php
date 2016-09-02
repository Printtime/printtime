<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('extension');
            $table->string('filename');
            $table->string('size');
            $table->integer('order_id')->unsigned()->index();

            $table->boolean('confirmed');
            $table->integer('side')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table('orders', function ($table) {
            $table->string('title')->nullable()->change();
            $table->string('comment')->nullable()->change();
            $table->integer('width')->nullable()->change();
            $table->integer('height')->nullable()->change();
        });

        Schema::table('users', function ($table) {
            $table->decimal('balance', 8, 2)->default('0.00')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('print_files');
    }
}
