<?php

namespace App\Http\Controllers;

use Request;

#use Illuminate\Http\Request;

#use App\Http\Requests;

class AjaxController extends Controller
{
    public function get()
    {	
        if (Request::ajax()) {
            return view('ajax.index');
        } 
    }

    public function post(Request $request)
    {	
        if (Request::ajax()) {
            return dd($request);
        } else {

            return 'this post send ok';
        }
    }
}
