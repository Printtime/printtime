<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Plupload;

class PrintFileController extends Controller
{
    public function index()
    {	
        return view('printfile.index');
    }

    public function form()
    {	
        return view('printfile.form');
    }

    public function upload(Request $request)
    {	

    return Plupload::receive('file', function ($file)
    {
        $file->move(storage_path() . '/print/', $file->getClientOriginalName());

        return 'ready';
    });

    	// return dd($request->ajax());
    	// if($request->ajax()){
     //    		echo 'ajax';
     //    }

     //    return dd($request);
    }
}
