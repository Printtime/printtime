<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
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

   public function index()
    {   
        $orders = Order::with('typevar', 'status')->where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate('20');
        return view('user.order.index', compact('orders'));
    }

   public function show($id)
    {   
        $order = Order::with('typevar', 'status')->where('user_id', auth()->user()->id)->find($id);
        return view('user.order.show', compact('order'));
    }

   public function edit($id)
    {   

        $order = Order::with('typevar', 'status')->where('user_id', auth()->user()->id)->find($id);

        $order->setStatus(8);

        return view('user.order.create', [
            'order'=>$order,
            'value'=>$order->typevar,
            'getPostpressArr'=>$order->getPostpressArr(),

            ]);
        
    }

   public function delete($id)
    {   
        $order = Order::with('typevar', 'status')->where('user_id', auth()->user()->id)->find($id);
        $order->setStatus(7);
        return redirect()->route('order.index');
    }

   public function create($id)
    {	
        $value = TypeVar::findOrFail($id);
        $getPostpressArr = null;
        return view('user.order.create', compact('value', 'getPostpressArr'));
    }

/*
   public function setStatus($id, $status)
    {   
        $order = Order::find($id);
        $order->status_id = $status;
        $order->save();

        if($status == '7') {
            $user = User::find($order->user_id);
            $user->balance = $user->balance + $order->sum;
            $user->save();
        }
        return back();
    }
*/

   public function update(Request $request, $id)
    {   



        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'sum' => 'required|min:1',
        ], []);

        if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
        }
            
            $order = Order::findOrFail($id);
            $order->title = $request->title;
            $order->comment = $request->comment;
            $order->status_id = 8;
            $order->count = $request->count;
            $order->width = $request->width;
            $order->height = $request->height;
            $order->sum = $request->sum;
            $order->save();

            if(isset($request->postpress)) {
                $postpress = [];
                foreach ($request->postpress as $key => $value) {
                    if($value != 0) { $postpress[$key] = ['var'=>$value]; }
                }
                $order->postpress()->sync($postpress);
            }


            PrintFile::where('filename', $request->file0)->update(['order_id' => $order->id, 'side' => '1']);
            PrintFile::where('filename', $request->file1)->update(['order_id' => $order->id, 'side' => '2']);

          return redirect()->route('order.index');
    }


   public function save(Request $request, $id)
    {	


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'sum' => 'required|min:1',
        ], []);

        if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
        }
           

            $order = new Order;
            $order->title = $request->title;
            $order->comment = $request->comment;
            $order->user_id = auth()->user()->id;
            $order->type_var_id = $id;
            $order->status_id = 8;
            $order->count = $request->count;
            $order->width = $request->width;
            $order->height = $request->height;
            $order->sum = $request->sum;
            $order->save();


            if(isset($request->postpress)) {
                $postpress = [];
                foreach ($request->postpress as $key => $value) {
                    if($value != 0) { $postpress[$key] = ['var'=>$value]; }
                }
                $order->postpress()->sync($postpress);
            }

            PrintFile::where('filename', $request->file0)->update(['order_id' => $order->id, 'side' => '1']);
            PrintFile::where('filename', $request->file1)->update(['order_id' => $order->id, 'side' => '2']);

          return redirect()->route('order.index');
    }
}
