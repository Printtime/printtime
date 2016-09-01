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
            $table->integer('status_id')->unsigned()->index();
            $table->integer('side')->unsigned()->index();
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
        Schema::drop('print_files');
    }
}
