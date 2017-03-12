<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('types', function ($table) {
            $table->string('semantic')->nullable();
            $table->string('roll_width')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('types', function ($table) {
            $table->dropColumn('semantic');
            $table->dropColumn('roll_width');
        });
    }
}
