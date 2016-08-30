<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Model\Order;
use App\Model\PrintFile;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;
use Validator;

class OrderController extends Controller
{

   public function index()
    {   
        $orders = Order::with('typevar', 'status')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate('10');
        return view('order.index', compact('orders'));
    }

   public function create($id)
    {	
    	$typevar = TypeVar::findOrFail($id);
    	return view('order.create',  compact('typevar'));
    }

   public function save(Request $request, $id)
    {	


        $messages = [
            'file1.required' => 'Загрузите файл макета, кликнув на "Загрузить лицевю сторону"',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file1' => 'required',
            'sum' => 'required',
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

            PrintFile::where('filename', $request->file1)->update(['order_id' => $order->id, 'side' => '1']);
            PrintFile::where('filename', $request->file2)->update(['order_id' => $order->id, 'side' => '2']);

          return redirect()->route('order.index');
    }
}
