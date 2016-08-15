<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action');
            $table->tinyInteger('payment_id');
            $table->string('status');
            $table->tinyInteger('version');
            $table->string('type');
            $table->tinyInteger('acq_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('liqpay_order_id');
            $table->string('description');
            $table->string('sender_card_mask2');
            $table->string('sender_card_bank');
            $table->string('sender_card_country');
            $table->string('ip');
            $table->decimal('amount');
            $table->decimal('sender_commission', 5, 2);
            $table->decimal('receiver_commission', 5, 2);
            $table->decimal('agent_commission', 5, 2);
            $table->decimal('amount_debit', 5, 2);
            $table->decimal('amount_credit', 5, 2);
            $table->decimal('commission_debit', 5, 2);
            $table->decimal('commission_credit', 5, 2);
            $table->string('currency_debit');
            $table->string('currency_credit');
            $table->decimal('sender_bonus', 5, 2);
            $table->decimal('amount_bonus', 5, 2);
            $table->string('mpi_eci');
            $table->boolean('is_3ds');
            $table->tinyInteger('transaction_id');
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
        Schema::drop('pays');
    }
}
