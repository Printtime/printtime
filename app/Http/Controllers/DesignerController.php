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

        $orders = Order::with('typevar', 'status')
        ->where('status_id', 1)
        ->orWhere('status_id', 2)
        ->orderBy('id', 'desc')
        ->paginate('20');
        return view('designer.index',  compact('orders'));

    }

    public function show($id)
    {   	
        $order = Order::with('typevar', 'status')->find($id);
        #if($order->status_id != 2) { $order->setStatus(2); }


        $getPostpressArr = $order->getPostpressArr();
        return view('designer.show', compact('order', 'getPostpressArr'));
    }

   public function update(Request $request, $id)
    {       

        $order = Order::find($id);
        


        if(isset($request->file0)) { PrintFile::where('filename', $request->file0)->update(['order_id' => $id, 'side' => '1']); }
        if(isset($request->file1)) { PrintFile::where('filename', $request->file1)->update(['order_id' => $id, 'side' => '2']); }

        if(count($request->confirmed) == 0) {
            $order->setStatus(1);
            PrintFile::where('order_id', $id)->update(['confirmed' => false]);
        }
        
        //Выбрать файлы для печати
        if(isset($request->confirmed)) {
                
                PrintFile::where('order_id', $id)->update(['confirmed' => false]);
                
                foreach ($request->confirmed as $file_id) {
                    PrintFile::where('id', $file_id)->update(['confirmed' => true]);
                }

                $order->setStatus(2);
        }

        return back();
    }


}
