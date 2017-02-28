<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPricePostpress extends Migration
{
    /**
     * Run the migrations PostPressPrice
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postpress_data', function ($table) {
            $table->decimal('ppprice', 8, 2)->nullable();
            $table->tinyInteger('ppprice_count')->nullable();
            $table->string('ppprice_desc')->nullable();
        });
    }

    /**
     * Reverse the migrations PostPressPrice
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postpress_data', function ($table) {
            $table->dropColumn('ppprice');
            $table->dropColumn('ppprice_count');
            $table->dropColumn('ppprice_desc');
        });
    }
}
