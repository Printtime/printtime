<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePrintFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('print_files', function ($table) {
            $table->integer('user_id')->unsigned()->index();
            $table->string('width');
            $table->string('height');
            $table->string('resolution');
            $table->string('mimetype');
            //$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('print_files', function ($table) {
            $table->dropColumn('user_id');
            $table->dropColumn('width');
            $table->dropColumn('height');
            $table->dropColumn('resolution');
            $table->dropColumn('mimetype');
        });
    }
}
