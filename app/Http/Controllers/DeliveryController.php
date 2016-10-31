<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Delivery;

class DeliveryController extends Controller
{

   public function novaposhta(Request $request) {
			return Delivery::novaposhta($request->name, $request->properties);
	}

}
