<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Model\Order;
use App\Model\PrintFile;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;


class DesignerController extends Controller
{
    public function index(Request $request, $status = 1)
    {   	

        if(isset($request->sort)) { $sort = 'desc'; } else { $sort = 'asc'; }

        $orders = Order::with('typevar', 'typevar.type', 'typevar.variable', 'status')
        ->where('status_id', $status)
        ->orderBy('updated_at', $sort)->paginate('20')->appends(['sort' => $sort]);

        return view('designer.index',  compact('orders'));

    }

    public function show($id)
    {   	
        $order = Order::with('typevar', 'status')->find($id);
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
