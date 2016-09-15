<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login');
            $table->ipAddress('remote_ip');
            $table->integer('web_remote_port');
            $table->string('web_remote_dir');
            $table->ipAddress('local_ip');
            $table->integer('web_local_port');
            $table->string('web_local_dir');
            $table->timestamps();
        });
        
        Schema::table('print_files', function ($table) {
            $table->integer('server_id')->unsigned()->index();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers');

        Schema::table('print_files', function ($table) {
            $table->dropColumn('server_id');
        });
    }
}
