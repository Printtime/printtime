<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use SleepingOwl\Admin\Http\Controllers\AdminController;

use App\Model\Product;
use App\Model\Catalog;
use App\Model\Post;
use App\User;

class HomeController extends AdminController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {   

        return $this->renderContent(
            view('dashboard')
                ->with('count', [
                    'product'=> Product::count(),
                    'catalog'=> Catalog::count(),
                    'post'=> Post::count(),
                    'user'=> User::count()
                    ])
            );
        #return $this->renderContent(view('dashboard'));
    }
}
