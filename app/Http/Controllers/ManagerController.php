<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Pay;
use App\Model\Order;
use App\Model\PrintFile;
use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;
use DB;
class ManagerController extends Controller
{
    public function index()
    {   	
		return redirect()->route('manager.orders');
    }

    public function orders()
    {   

    	 $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
    	 ->join('statuses', 'statuses.id', '=', 'orders.status_id')
    	 ->join('type_var', 'orders.type_var_id', '=', 'type_var.id')
    	 ->join('types', 'types.id', '=', 'type_id')
    	 ->join('vars', 'vars.id', '=', 'var_id')
    	 ->select(
    	 	'orders.id', 'orders.title', 'orders.sum', 'orders.created_at', 'orders.comment',  'orders.status_id',
    	 	'users.name', 'statuses.title as status',
    	 	'types.title as type', 'vars.title as var'
    	 	)
    	 ->orderBy('orders.id', 'desc')
    	 ->paginate('20');
    	
       return view('manager.orders', compact('orders'));
    }

    public function users()
    {   	
    	$users = User::join('orders', 'users.id', '=', 'orders.user_id')
            ->groupBy('orders.user_id')
            ->select('users.*', DB::raw('count(*) as orders_count'))
    	 	->orderBy('users.id', 'desc')
            ->paginate(20);

       return view('manager.users', compact('users'));
    }

    public function pays()
    {   	
    	$pays = Pay::join('users', 'users.id', '=', 'pays.user_id')
    	->select('pays.*', 'users.name')
    	->orderBy('pays.id', 'desc')
    	->paginate(20);
    	#dd($pays);
       return view('manager.pays', compact('pays'));
    }
}
