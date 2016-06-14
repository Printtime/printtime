<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Page;
use App\Model\Catalog;

use Illuminate\Contracts\View\View;

class CatalogController extends Controller
{
    public function index()
    {	
        return view('catalog.index')->with('catalogs', Catalog::orderBy('order', 'asc')->get())->with('page', Page::find('1'));
    }

    public function show($id)
    {
        return view('catalog.show', [
        	'catalog' => Catalog::find($id), 
        	'catalogs' => Catalog::with('products')->orderBy('order', 'asc')->get(), 
        	]);
        #return view('catalog.show')->with('catalogs', Catalog::with('products')->orderBy('order', 'asc')->get())->with('catalog', Catalog::find($id));
    }


    public function portfolio()
    {   
        return view('catalog.portfolio')->with('catalogs', Catalog::orderBy('order', 'asc')->get());
    }
}
