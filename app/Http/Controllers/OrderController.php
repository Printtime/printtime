<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Model\Type;
use App\Model\TypeVar;
use App\Model\Variable;

class OrderController extends Controller
{
   public function create($id)
    {	
    	$typevar = TypeVar::findOrFail($id);
    	#return dd($typevar->variable);
    	return view('order.create',  compact('typevar'));
    }
   public function save(Request $request, $id)
    {	
    	return $request->count.' <br> '.$request->width.' <br> '.$request->height.' <br> '.$request->file1.' <br> '.$request->file2;
    }
}
