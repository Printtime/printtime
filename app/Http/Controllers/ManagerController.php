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
       return view('manager.users')->with('users', Controller::users());
    }

    public function pays(Request $request)
    {   	
    	$pays = Pay::join('users', 'users.id', '=', 'pays.user_id')
    	->select('pays.*', 'users.name')
    	->orderBy('pays.id', 'desc');
        if($request->user_id) { $pays->where('user_id', $request->user_id); }
        $pays = $pays->paginate(20);
        if($request->user_id) { $pays->appends(['user_id' => $request->user_id]); }
        
       return view('manager.pays', compact('pays'));
    }

    public function edit(Request $request)
    {
       $user = User::find($request->id);
       return view('manager.form.edit', compact('user'));
    }

    public function edit_update(Request $request)
    {   
        $user = User::find($request->id);

        $data = $request->all();

        if($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        
        $user->fill($data)->save();
        return back();
    }



    public function pay_form(Request $request)
    {
       $user = User::find($request->id);
       return view('manager.form.pay', compact('user'));
    }


    public function pay_create(Request $request)
    {   

        $user = User::find($request->id);
            if($request->type == 'buy') {
            $user->balance = $user->balance + $request->amount;
            }
            if($request->type == 'sell') {
            $user->balance = $user->balance - $request->amount;
            }
        $user->save();


        $pay = new Pay();
        $pay->status = 'local';
        $pay->user_id = $request->id;
        $pay->amount = $request->amount;
        $pay->description = $request->description." \nОстаток баланса ".$user->balance." грн. на ".date("d.m.Y H:i:s");
        $pay->type = $request->type;
        $pay->save();

        return back();

    }


}
