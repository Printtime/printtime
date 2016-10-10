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
use Image;

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

   public function tiff($filename = null)
    {   
        
        if($filename) {

            $path = storage_path('print/'.$filename);
            $EXIF = exif_read_data($path, 'IFD0');
            //$data['Имя'] = $EXIF['FileName'];
            //$data['Размер (байт)'] = $EXIF['FileSize'];
            //$data['FileType'] = $EXIF['FileType'];
            //$data['MimeType'] = $EXIF['MimeType'];

            $data['Ширина (px)'] = $EXIF['ImageWidth'];
            $data['Высота (px)'] = $EXIF['ImageLength'];

            $data['XResolution'] = explode('/', $EXIF['XResolution']);
            $data['XResolution'] = $data['XResolution'][0] / $data['XResolution'][1];
            #$data['Ширина (DPI)'] = $data['XResolution'];
            $data['Ширина (mm)'] = round($EXIF['ImageWidth']/($data['XResolution']/25.4), 2);

            $data['YResolution'] = explode('/', $EXIF['YResolution']);
            $data['YResolution'] = $data['YResolution'][0] / $data['YResolution'][1];
            #$data['Высота (DPI)'] = $data['YResolution'];
            $data['Высота (mm)'] = round($EXIF['ImageLength']/($data['YResolution']/25.4), 2);

            $data['Точек на дюйм'] = $data['XResolution']; 

            unset($data['XResolution']);
            unset($data['YResolution']);

            return $data;
        }

        $files = Storage::disk('print')->files();

        $extensions = array('tif', 'tiff');
        $images = array_filter($files, function($file) use ($extensions) {
             $pos = strrpos($file, '.');
             $extension = strtolower(substr($file, $pos + 1));
             return in_array($extension, $extensions);
        });

        foreach ($images as $file) {
           echo '<a href="'.route('system.tiff', $file).'">'.$file.'</a></br>';
        }


        return '<hr>:)';

    }


}
