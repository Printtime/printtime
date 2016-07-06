<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrfail($id);
        return view('product.show', ['product'=> $product]);
    }

   public function order(Request $request, $product)
    {
        if($request->ajax()){
            return view('product.order.index', ['product'=> $product]);
        } 
    }

    public function orderSend(Request $request, $product)
    {	
        if($request->ajax()){

			    $client = new \GuzzleHttp\Client();

			    $qtext = urlencode($request->email.' '.$request->phone.' '.$request->comment);
 				$q = 'https://api.telegram.org/bot'.$_ENV["TELEGRAM_BOT_ID"].'/sendMessage?chat_id='.$_ENV["TELEGRAM_CHAT_ID"].'&text='.$qtext.'';

 				$body = $client->get($q)->getBody();

				$obj = json_decode($body);
				
				/*if($obj->ok == true)  {
 					return redirect()->back()->with('status', 'Отправлено успешно!');
 				}*/

 				if($obj->ok == true)  {
 					return view('product.order.success');
 				}

        }
    }

}
