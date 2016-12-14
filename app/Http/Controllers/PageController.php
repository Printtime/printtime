<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Page;

class PageController extends Controller
{
    public function show($id)
    {

		\Breadcrumbs::register('show', function($breadcrumbs, $page)
		{	
			
				$breadcrumbs->parent('home');

			if($page->parent_id != 3 and $page->id != 3) {
				$breadcrumbs->parent('printers');
			}

				if($page->parent_id) {
					$parent_page = Page::find($page->parent_id);
					$breadcrumbs->push($parent_page->title, route('page.show', $page->parent_id));
				}
			
		    $breadcrumbs->push($page->title, route('page.show', $page->id));
		});

        return view('page.show')->with('page', Page::find($id));
    }
}
