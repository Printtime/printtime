<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Model\Order;
use App\Model\PrintFile;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;
use App\Model\Postpress;
use App\Pay;
use Validator;

class OrderController extends Controller
{
   public static function postpress_data()
    {
        $postpress_data['obrezka'] = [
          '0' => 'Без обрезки',
          '1' => 'Обрезать в размер'
        ];

        $postpress_data['luvers'] = [
          '0' => 'Нет',
          '1' => 'По углам',
          '2' => 'По периметру',
          '3' => 'Верх',
          '4' => 'Верх и низ',
          '5' => 'Лево и право',
        ];

        $postpress_data['podvorot'] = [
          '0' => 'Нет',
          '1' => 'Есть',
        ];

        return $postpress_data;
    }

   public function index()
    {   
        $orders = Order::with('typevar', 'status')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate('10');
        return view('order.index', compact('orders'));
    }

   public function show($id)
    {   
        $postpress_data = $this->postpress_data();
        $order = Order::with('typevar', 'status')->where('user_id', auth()->user()->id)->find($id);
        return view('user.order', compact('order', 'postpress_data'));
    }

   public function create($id)
    {	
        $typevar = TypeVar::findOrFail($id);
        $postpress_data = $this->postpress_data();
        $postpress = Postpress::where('product_id', $typevar->type->product_id)->get();
        $postpressview = Postpress::where('product_id', $typevar->type->product_id)->groupBy('view')->get();
        
    	return view('order.create',  compact('typevar', 'postpress', 'postpressview', 'postpress_data'));
    }

   public function setStatus($id, $status)
    {   
        $order = Order::find($id);
        $order->status_id = $status;
        $order->save();
        return back();
    }

   public function save(Request $request, $id)
    {	

        $messages = [
            'file1.required' => 'Загрузите файл макета, кликнув на "Загрузить лицевую сторону"',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file1' => 'required',
            'sum' => 'required|min:1',
        ], $messages);

        if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
        }
            
            if ($request->sum > auth()->user()->balance) {
                $no_money = auth()->user()->balance - $request->sum;
                return back()->withErrors(['sum'=>'На вашем балансе нехватает '.$no_money.' грн.'])->withInput();
            }

            $order = new Order;
            $order->title = $request->title;
            $order->comment = $request->comment;
            $order->user_id = auth()->user()->id;
            $order->type_var_id = $id;
            $order->count = $request->count;
            $order->width = $request->width;
            $order->height = $request->height;
            $order->sum = $request->sum;
            $order->save();


            if($request->obrezka) {
                $obrezka_obj = Postpress::where('name', 'obrezka')->first();
                $order->postpress()->attach([ $obrezka_obj->id =>['var'=>$request->obrezka]]);
            }
            if($request->luvers) {
                $luvers_obj = Postpress::where('name', 'luvers')->first();
                $order->postpress()->attach([ $luvers_obj->id =>['var'=>$request->luvers]]);
            }
            if($request->podvorot) {
                $podvorot_obj = Postpress::where('name', 'podvorot')->first();
                $order->postpress()->attach([ $podvorot_obj->id =>['var'=>$request->podvorot]]);
            }


            $user = auth()->user();
            $user->balance = $user->balance - $request->sum;
            $user->save();

            PrintFile::where('filename', $request->file1)->update(['order_id' => $order->id, 'side' => '1']);
            PrintFile::where('filename', $request->file2)->update(['order_id' => $order->id, 'side' => '2']);

          return redirect()->route('order.index');
    }
}
