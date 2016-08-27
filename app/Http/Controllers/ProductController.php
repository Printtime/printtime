<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Catalog;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;
use DB;

class ProductController extends Controller
{
    public function show($catalog, $product)
    {   
        $product = Product::findOrfail($product);
        $catalog = Catalog::findOrfail($catalog);
        return view('product.show', ['catalog'=> $catalog, 'product'=> $product]);
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
				

 				if($obj->ok == true)  {
 					return view('product.order.success');
 				}

        }
    }

   public function product($product)
    {   

        $types = DB::table('types')->where('product_id', $product)->get();

        $rows = DB::table('type_var')
            ->Join('types', 'type_var.type_id', '=', 'types.id')
            ->Join('vars', 'type_var.var_id', '=', 'vars.id')
            ->where('types.product_id', $product)
            ->select('*', 'type_var.id as type_var_id')
            ->get();

        $headers = DB::table('types')
            ->where('types.product_id', $product)
            ->Join('type_var', 'type_var.type_id', '=', 'types.id')
            ->Join('vars', 'vars.id', '=', 'type_var.var_id')
            ->groupby('vars.id')
            ->get();


            foreach ($types as $type) {
                foreach ($rows as $row) {
                    if($type->id == $row->type_id)
                    {   
                        $type->data[$row->var_id] = $row;
                    }
                }

                foreach($headers as $header) {

                    $type->res[$header->id] = 'no-data';

                    if(isset($type->data[$header->id])) {
                        $type->res[$header->id] = $type->data[$header->id];
                    }
                }
            }
        return view('product.table',  compact('rows', 'types', 'headers'));
    }

   public function products()
    {   
        $products = Product::has('types')->get();
        return view('product.index',  compact('products'));
    }


}
