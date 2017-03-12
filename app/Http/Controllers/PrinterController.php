<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#use App\Http\Requests;

use App\Model\Order;
use App\Model\PrintFile;
use App\Model\Servers;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;
use App\User;

use Storage;

class PrinterController extends Controller
{
    public function index($status = 2)
    {   	   
        #return dd($request->status);
        #$orders = Order::with('typevar', 'status')->where('status_id', '>=', '2')->where('status_id', '<=', '5')->Orwhere('status_id', '=', '9')->orderBy('id', 'desc')->paginate('20');
        $orders = Order::with('typevar', 'typevar.type', 'typevar.variable', 'status', 'user', 'printerfiles.server', 'getPostpress')
        ->where('status_id', $status)->orderBy('created_at', 'asc')
        ->get();

       # $postpress_data = OrderController::postpress_data();
        return view('printer.index',  compact('orders'));
    }

    public function user_orders($user_id)
    {
             $orders = Order::with('typevar', 'typevar.type', 'typevar.variable', 'status', 'user', 'printerfiles.server', 'getPostpress')
            ->where('user_id', $user_id)
            
            ->orderBy('created_at', 'desc')
            ->get(); 

            $user = User::find($user_id);
            return view('printer.index')->with('orders', $orders)->with('user', $user);
    }

    public function users()
    {
            return view('printer.users')->with('users', Controller::users());
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
