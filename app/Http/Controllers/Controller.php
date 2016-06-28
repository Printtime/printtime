<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Model\Slider;
use App\Model\Product;
use App\Model\Catalog;
use Illuminate\Contracts\View\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function compose(View $view)
    {
        $view->with('slider', Slider::orderBy('order', 'asc')->get());
        $view->with('compose_catalog', $this->compose_catalog());
    }

   public function compose_catalog()
    {   
        return Catalog::with('products')->orderBy('order', 'asc')->get();
    }
}
