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

        $orders = Order::with('typevar', 'status')->where('status_id', '1')->orderBy('id', 'desc')->paginate('20');
        return view('designer.index',  compact('orders'));

    }

    public function show($id)
    {   	
        $order = Order::find($id);
        return view('designer.show',  compact('order'));

    }
}
