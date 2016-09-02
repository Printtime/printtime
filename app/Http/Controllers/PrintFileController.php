<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Model\PrintFile;
use Plupload;
use File;
use Storage;

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
            $dir_path = storage_path() . '/print/';
            $file->move($dir_path, $fname);

            $storage = Storage::disk('print');

            if(!$storage->exists($fname)) {
                return abort();
            }

            $printfile = new PrintFile;
            $printfile->name = $file->getClientOriginalName();
            $printfile->extension = $file->getClientOriginalExtension();
            $printfile->filename = $fname;
            $printfile->size = $storage->size($fname);
            $printfile->save();

            return ['fname'=>$fname];
        });
    }
}