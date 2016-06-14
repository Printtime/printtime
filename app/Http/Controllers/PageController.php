<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Page;

class PageController extends Controller
{
    public function show($id)
    {
        return view('page.show')->with('page', Page::find($id));
    }
}
