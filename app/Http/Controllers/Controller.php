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

    public function print_preview_path_file($filename)
    {
        $name=explode(".", $filename, 2); 
        return 'images/print_preview/'.$name[0].'.jpg';
    }

    public function tiff2jpg_convert($filename, $jpg)
    {   
        /*
        $path = storage_path('print/'.$filename);

        if (file_exists($path)) {

            exec('nice -n 19 convert -profile "../storage/icc/CMYK_Profiles/CoatedFOGRA27.icc" '.$path.' -profile "../storage/icc/RGB_Profiles/AppleRGB.icc" -quality 80 -resize 256x256 '.$jpg.'');
        }
        */

    }

   public function tiff2jpg($filename = null)
    {   
        header('Content-Type: image/jpeg');

        $jpg = $this->print_preview_path_file($filename);

        if (file_exists($jpg)) {
                return readfile($jpg);
        } else {
            $this->tiff2jpg_convert($filename, $jpg);
        }
            
            return readfile($jpg);
    }

   public function tiff($EXIF = null, $filename = null)
    {   
        
        if($EXIF) {



            $data['XResolution'] = explode('/', $EXIF['XResolution']);
            $data['XResolution'] = $data['XResolution'][0] / $data['XResolution'][1];
            $width = round(round($EXIF['ImageWidth']/($data['XResolution']/25.4)));
            if(mb_strlen($width) >= 4) { $width = round($width, -1); }

            $data['YResolution'] = explode('/', $EXIF['YResolution']);
            $data['YResolution'] = $data['YResolution'][0] / $data['YResolution'][1];
            $height = round(round($EXIF['ImageLength']/($data['YResolution']/25.4)));
            if(mb_strlen($height) >= 4) { $height = round($height, -1); }

            $resolution = ceil(($data['XResolution']+$data['YResolution'])/2); 

            unset($data['XResolution']);
            unset($data['YResolution']);

            $jpg = $this->print_preview_path_file($filename);
            $this->tiff2jpg_convert($filename, $jpg);

            switch ($EXIF['MimeType']) {
                case 'image/tiff':
                    $data['mimetype']['title'] = 'Тип файла: TIFF';
                    $data['mimetype']['valid'] = true;
                    $data['mimetype']['data'] = $EXIF['MimeType'];
                    break;
                default:
                    $data['mimetype']['title'] = 'Загрузите TIFF файл';
                    $data['mimetype']['valid'] = false;
                    $data['mimetype']['data'] = $EXIF['MimeType'];
            }

            switch ($width) {
                case ($width < 40):
                    $data['width']['title'] = 'Ширина макета: '.$width.'мм, допустимо не менее 40 мм';
                    $data['width']['valid'] = false;
                    $data['width']['data'] = $width;
                    break;
                case ($width >= 40):
                    $data['width']['title'] = 'Ширина макета: '.$width.' мм';
                    $data['width']['valid'] = true;
                    $data['width']['data'] = $width;
                    break;
                default:
                    $data['width']['title'] = 'Ширина не определена';
                    $data['width']['valid'] = false;
                    $data['width']['data'] = '';
            }

            switch ($height) {
                case ($height < 40):
                    $data['height']['title'] = 'Высота макета: '.$height.' мм, допустимо не менее 40 мм';
                    $data['height']['valid'] = false;
                    $data['height']['data'] = $height;
                    break;
                case ($height >= 40):
                    $data['height']['title'] = 'Высота макета: '.$height.' мм';
                    $data['height']['valid'] = true;
                    $data['height']['data'] = $height;
                    break;
                default:
                    $data['height']['title'] = 'Высота не определена';
                    $data['height']['valid'] = false;
            }


            switch ($EXIF['SamplesPerPixel']) {
                case 3:
                    $data['color']['title'] = 'Цветовая модель: RGB, допустимо только CMYK';
                    $data['color']['valid'] = false;
                    break;
                case 4:
                    $data['color']['title'] = 'Цветовая модель: CMYK';
                    $data['color']['valid'] = true;
                    break;
                default:
                    $data['color']['title'] = 'Цветовая модель не определена';
                    $data['color']['valid'] = false;
            }

            switch ($resolution) {
                case ($resolution < 45):
                    $data['resolution']['title'] = 'Разрешение макета: '.$resolution.' dpi, допустимо не менее 45 dpi';
                    $data['resolution']['valid'] = false;
                    $data['resolution']['data'] = '';
                    break;
                case ($resolution >= 45):
                    $data['resolution']['title'] = 'Разрешение макета: '.$resolution.' dpi';
                    $data['resolution']['valid'] = true;
                    $data['resolution']['data'] = $resolution;
                    break;
                default:
                    $data['resolution']['title'] = 'Разрешение не определено';
                    $data['resolution']['valid'] = false;
                    $data['resolution']['data'] = '';
            }

            switch ($EXIF['Compression']) {
                case 1:
                    $data['compression']['title'] = 'Без сжатия';
                    $data['compression']['valid'] = true;
                    break;
                case 5:
                    $data['compression']['title'] = 'Сжатие: LZW';
                    $data['compression']['valid'] = true;
                    break;
                case 8:
                    $data['compression']['title'] = 'Сжатие: ZIP';
                    $data['compression']['valid'] = true;
                    break;
                default:
                    $data['compression']['title'] = 'Сжатие не определено';
                    $data['compression']['valid'] = false;
            }

            $data['fname'] = $filename;

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
