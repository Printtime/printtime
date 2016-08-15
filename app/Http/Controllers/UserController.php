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

    public function order()
    {   
    	return view('user.order');
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
}