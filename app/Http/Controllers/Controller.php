<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Model\Slider;
use App\Model\Product;
use App\Model\Catalog;
use App\Model\PrintFile;
use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function compose(View $view)
    {
        $view->with('slider', Slider::orderBy('order', 'asc')->get());
        $view->with('compose_catalog', $this->compose_catalog());
    }

   public function cleaner()
    {   

        $printfiles = PrintFile::where('created_at', '<', Carbon::yesterday())
        ->where('order_id', '0')
        ->where('confirmed', '0')
        ->where('side', '0')
        ->where('server_id', '0')
        ->get();

        $res = [];

        foreach ($printfiles as $file) {
                    $storage = Storage::disk('print');
                    if($storage->exists($file->filename)) {
                        $storage->delete($file->filename);
                        PrintFile::where('filename', $file->filename)->delete();
                        $res[] = $file->filename;
                    }
        }
        return response()->json($res);
    }

   public function compose_catalog()
    {   
        return Catalog::with('products')->orderBy('order', 'asc')->get();
    }
}
