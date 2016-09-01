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
<<<<<<< HEAD
            $table->integer('status_id')->unsigned()->index();
            $table->integer('side')->unsigned()->index();
            $table->timestamps();
        });
=======
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
>>>>>>> fae5d7c2a9f7a2ad25c6110fc4d08486ca13a5e0
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
