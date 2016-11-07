<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Model\Order;
use App\Model\PrintFile;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;


class DesignerController extends Controller
{
    public function index()
    {   	

        $orders = Order::with('typevar')->where('status_id', '1')->orderBy('id', 'desc')->paginate('20');
        return view('designer.index',  compact('orders'));

    }

    public function show($id)
    {   	
        $order = Order::with('typevar', 'status')->find($id);
        $getPostpressArr = $order->getPostpressArr();
        return view('designer.show', compact('order', 'getPostpressArr'));

        #$postpress_data = OrderController::postpress_data();
        #$order = Order::with('files')->find($id);
        #return view('designer.show',  compact('order', 'postpress_data'));

    }

   public function update(Request $request, $id)
    {       
        $order = Order::find($id);
        $order->setStatus(2);

        if(isset($request->file0)) { PrintFile::where('filename', $request->file0)->update(['order_id' => $id, 'side' => '1']); }
        if(isset($request->file0)) { PrintFile::where('filename', $request->file1)->update(['order_id' => $id, 'side' => '2']); }

        return back();
    }


}
