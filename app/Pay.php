<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
  protected $table = 'pays';
  
    protected $fillable = [
	'id', 
	'action', 
	'payment_id', 
	'status', 
	'version', 
	'type', 
	'acq_id', 
	'user_id', 
	'liqpay_order_id', 
	'description', 
	'sender_card_mask2', 
	'sender_card_bank', 
	'sender_card_country', 
	'ip', 
	'amount', 
	'sender_commission', 
	'receiver_commission', 
	'agent_commission', 
	'amount_debit', 
	'amount_credit', 
	'commission_debit', 
	'commission_credit', 
	'currency_debit', 
	'currency_credit', 
	'sender_bonus', 
	'amount_bonus', 
	'mpi_eci', 
	'is_3ds', 
	'transaction_id', 
	];


}
