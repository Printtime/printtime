<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Model\Order;
use App\Model\PrintFile;
use App\Model\Servers;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;

use Storage;

class PrinterController extends Controller
{
    public function index()
    {   	
        $orders = Order::with('typevar', 'status')->where('status_id', '>=', '2')->where('status_id', '<=', '5')->orderBy('id', 'desc')->paginate('20');
        $postpress_data = OrderController::postpress_data();
        return view('printer.index',  compact('orders', 'postpress_data'));
    }

    public function show($id)
    {   	
        $order = Order::with('files')->find($id);

        foreach ($order->files as $file) {

            if($file->server_id >= 1 and $file->side >= 1) {
             $obj = Servers::find($file->server_id);
             
             $size = file_get_contents('http://'.$obj->remote_ip.':'.$obj->web_remote_port.'/'.$obj->web_remote_dir.'/?filename='.$file->filename.'');

             if($size == $file->size) {
                    $file->confirmed = '1';
                    $file->save();

                    $storage = Storage::disk('print');
                    if($storage->exists($file->filename)) {
                        $storage->delete($file->filename);
                    }
             }

            }
            
        }

        $postpress_data = OrderController::postpress_data();
        return view('printer.show',  compact('order', 'postpress_data'));

    }
}
