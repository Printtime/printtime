<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\Catalog;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;

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
        #$typevars = TypeVar::all();
        $vars = Variable::get();
        $typevars = TypeVar::get();
        $types = Type::where('product_id', $product)->get();
        #$headers = TypeVar::where('type_id', $product)->groupby('var_id')->get();
        return view('product.table',  compact('types', 'vars', 'typevars'));

    }

   public function products()
    {   

        $products = Product::has('types')->get();
        return view('product.index',  compact('products'));

        // $products = Product::has('types')->get();
        // foreach ($products as $product) {
        //     return dd($product->types);
        // }
         

        // $collection = collect($products);
        // #$filtered = $collection->whereIn('price', [150, 200]);
        // #$filtered->all();
        // return dd($collection->all());


        // $products = Product::has('types')->get();
        // $typevarsHeaders = TypeVar::groupby('var_id')->get();
        // $typevarsBody = TypeVar::groupby('type_id')->get();
        // $typevars = TypeVar::all();
        // $vars = Variable::all();
        // $types = Type::all();
        // return view('product.index',  compact('products', 'typevars', 'vars', 'types', 'typevarsHeaders'));
    }


}
