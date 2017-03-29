<?php

namespace App\Http\Controllers;

#use Gate;
use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
#use App\Role;

class UserController extends Controller
{
    public function index()
    {   
    	return view('user.index');
    }

    public function profileUpdate(Request $request)
    {   
       $user = User::findOrFail(Auth::id());

    $this->validate($request, [
        'name' => 'required',
        'phone' => 'required',
        'password' => 'min:6|confirmed',
        'password_confirmation' => 'min:6'
    ]);

        $user->fill([
            'name' => $request->name,
            'phone' => $request->phone
        ]);

        if($request->password) { $user->password = bcrypt($request->password); }
        $user->save();

        return back();
    }

    public function profile()
    {   
    	return view('user.profile');
    }


   public function transfer(Request $request)
    {
        if($request->ajax()){
            return view('pay.form');
        } 

        return view('pay.transfer');
    }

   public function transfer_disable(Request $request)
    {
        if($request->ajax()){
            return view('pay.disable');
        } 

        return view('pay.disable');
    }
}