<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
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
        #return view('printfile.form');
        return view('printfile.form');
    }

    public function upload3(Request $request)
    {
        
        return dd($request);
        return response()->json(['OK' => 1]);
    	#return 'good';
    }

    public function upload2(Request $request)
    {
    		if($request->ajax()){


    			if($request->uploadfileoffset == 0) {
	    			$data = explode(',', $request->uploadchunkdata);
	    			$filecontent = base64_decode($data[1]);
    			} else {
    				#$data = $request->uploadchunkdata;
    				$filecontent = base64_decode($request->uploadchunkdata);
    			}

    			#$file_name = md5($request->uploadchunkdata);
    			$file_name = 'test';
    			$filename = storage_path() . '/print/'.$file_name.'.png';
    			$f = fopen($filename, "ab");
				fwrite($f, $filecontent);
				#fwrite($f, $request->uploadfileoffset.' - '.$request->uploadfilename.' - '.$request->uploadfilesize.' ----- ');
				fclose($f);
				#return $request->uploadfilename;
				//return $data[1];
    			


    			#return $request->file;
    			return $request->uploadchunkdata;
    			return $request->email.' '.$request->phone.' '.$request->comment;
    		} else {
    			return false;
    		}
    		/*
    	return dd($request->all());
    	echo $request->name;
    	echo $request->filename;
    	return true;
    	*/
    }

    public function upload(Request $request)
    {	

	    return Plupload::receive('file', function ($file)
	    {	
            #return dd($file);
	    	#return dd($file->getClientOriginalExtension());
            #$file->getClientOriginalExtension()
	    	$fname = md5(Hash::make($file)).'.'.$file->getClientOriginalExtension();
	        #$file->move(storage_path() . '/print/', $file->getClientOriginalName());
	        $file->move(storage_path() . '/print/', $fname);
	        
	        return ['fname'=>$fname, 'ftype'=>'1'];
	    });
	}
}