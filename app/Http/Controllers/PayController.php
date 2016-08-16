<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use LiqPay;
use App\Pay;
use App\User;

class PayController extends Controller
{
    #private $public_key = $getkey->public_key;
    #private $private_key = $getkey->private_key;

   public function __construct()
    {
        $this->middleware('api', ['only' => ['api']]);
        $this->getkey();
    }

   private function getkey()
    {
        $this->public_key = getenv('LIQPAY_PUBLIC_KEY');
        $this->private_key = getenv('LIQPAY_PRIVATE_KEY');
    }



    public function index()
    {   
        $pays = Pay::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('pay.index',  compact('pays'));
    }

    public function redirect(Request $request)
    {	

        return redirect('/user');
    }

    public function product_url(Request $request)
    {
        #return dd($request);
    }
 
    public function result_url(Request $request)
    {
        #return dd($request);
    }


    public function create(Request $request)
    {   

    	$createPay = $this->createPay($request);

        $data =     [
        'version'       => '3', 
        'action'         => 'pay',
        'amount'         => $createPay->amount,
        'currency'       => 'UAH',
        'description'    => 'Пополение счета пользователя '.auth()->user()->name.', на сумму '.$createPay->amount,
        'order_id'       => $createPay->id,
        'sandbox'       => '1',
        #'product_url'       => 'http://printtime.dev/user',
        #'result_url'       => 'http://printtime.dev/user'
        ];

        $liqpay = new LiqPay($this->public_key, $this->private_key);
        $form = $liqpay->cnb_form($data);
        return view('pay.liqpay',  compact('form', 'request'));
    }


    public function createPay(Request $request)
    {
        $pay = new Pay();
        $pay->status = 'local';
        $pay->user_id = auth()->user()->id;
        $pay->amount = $request->amount; 
        $pay->save();
        return $pay;
    }

    //Списать
    public function debit($user_id, $amount)
    {
        $user = User::find($user_id);
        $user->balance = $user->balance - $amount;
        $user->save();
        #return true;
    }

    //Зачислить
    public function deposit($user_id, $amount)
    {   
        $user = User::find($user_id);
        $user->balance = $user->balance + $amount;
        $user->save();
        return $user;
    }

    public function api(Request $request)
    {

    $data = base64_decode($request->data);
    $data = json_decode($data);

Pay::where('id', $data->order_id)->update([
	'action' => $data->action,
	'payment_id' => $data->payment_id,
	'status' => $data->status,
	'version' => $data->version,
	'status' => $data->status,
	'type' => $data->type,
	'acq_id' => $data->acq_id,
	'liqpay_order_id' => $data->liqpay_order_id,
	'description' => $data->description,
	'sender_card_mask2' => $data->sender_card_mask2,
	'sender_card_bank' => $data->sender_card_bank,
	'sender_card_country' => $data->sender_card_country,
	'ip' => $data->ip,
	'amount' => $data->amount,
	'sender_commission' => $data->sender_commission,
	'receiver_commission' => $data->receiver_commission,
	'agent_commission' => $data->agent_commission,
	'amount_debit' => $data->amount_debit,
	'amount_credit' => $data->amount_credit,
	'commission_debit' => $data->commission_debit,
	'commission_credit' => $data->commission_credit,
	'currency_debit' => $data->currency_debit,
	'currency_credit' => $data->currency_credit,
	'sender_bonus' => $data->sender_bonus,
	'amount_bonus' => $data->amount_bonus,
	'mpi_eci' => $data->mpi_eci,
	'is_3ds' => $data->is_3ds,
	'transaction_id' => $data->transaction_id,
	]);

    if($data->status == 'success' AND $data->type == 'buy') {
        $this->deposit(auth()->user()->id, $data->amount);
    }

    return 'good';
    
    }

}
