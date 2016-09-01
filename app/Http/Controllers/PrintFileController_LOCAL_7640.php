<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Model\PrintFile;
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

	    	$fname = md5(Hash::make($file)).'.'.$file->getClientOriginalExtension();
	        $res = $file->move(storage_path() . '/print/', $fname);

            return dd($res);
            $printfile = new PrintFile;
            $printfile->name = $file->getClientOriginalName();
            $printfile->extension = $file->getClientOriginalExtension();
            $printfile->filename = $file->filename;
            $printfile->size = $file->size;
            $printfile->save();

	        return ['fname'=>$fname];
	    });
	}
}