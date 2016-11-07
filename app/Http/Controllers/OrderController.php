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
use App\Delivery;

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

            

                $delivery = Delivery::where('order_id', $id)->first();
                    
                if(!empty($delivery->order_id)) {
                    if(!empty($request->name) and !empty($request->city)) {
                        $delivery->order_id = $id;
                        $delivery->name = $request->name;
                        $delivery->phone = $request->phone;
                        $delivery->city = $request->city;
                        $delivery->warehouses = $request->warehouses;
                        $delivery->save();
                            //Обновляем получателя
                            // $delivery_array = [];
                            // $delivery_array['name'] = $request->get('name');
                            // $delivery_array['phone'] = $request->get('phone');
                            // $delivery_array['city'] = $request->get('city');
                            // $delivery_array['warehouses'] = $request->get('warehouses');
                            // $delivery->update($delivery_array);
                        } else {
                            //Удаляем получателя
                            $delivery->delete();
                        }
                } else {                    //Создаем получателя
                    
                    if(isset($id) AND count($request->name) >= 3 AND count($request->city) >= 3) {
                        $delivery = new Delivery;
                        $delivery->order_id = $id;
                        $delivery->name = $request->name;
                        $delivery->phone = $request->phone;
                        $delivery->city = $request->city;
                        $delivery->warehouses = $request->warehouses;
                        $delivery->save();
                    }
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

            if(isset($order->id) AND isset($request->name) AND isset($request->city) AND isset($request->warehouses)) {
                $delivery = new Delivery;
                $delivery->order_id = $order->id;
                $delivery->name = $request->name;
                $delivery->phone = $request->phone;
                $delivery->city = $request->city;
                $delivery->warehouses = $request->warehouses;
                $delivery->save();
            }

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
