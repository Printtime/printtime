<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Model\Order;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Model\PrintFile;
use App\Model\Servers;
use Plupload;
use File;
use Storage;


class PrintFileController extends Controller
{

    public function index()
    {   
        return view('printfile.index');
    }

    public function form()
    {   
        return view('printfile.form');
    }

    public function download($id, $server = 'local')
    {   

         $localfile = PrintFile::find($id);

        if($server == 'local') {
            $pathToFile = storage_path('print/'.$localfile->filename); 
            return response()->download($pathToFile);
        }

    }

    public function upload(Request $request)
    {   



        return Plupload::receive('file', function ($file)
        {    
            $fname = md5(Hash::make($file)).'.'.$file->getClientOriginalExtension();
            $dir_path = storage_path() . '/print/';
            $file->move($dir_path, $fname);

            $storage = Storage::disk('print');

            if(!$storage->exists($fname)) {
                return abort('404');
            }

            
            $path = storage_path('print/'.$fname);
            $EXIF = exif_read_data($path, 'IFD0');

            unset($EXIF['ExtensibleMetadataPlatform']);
            unset($EXIF['ImageResourceInformation']);
            unset($EXIF['IPTC/NAA']);
            unset($EXIF['ICC_Profile']);
            unset($EXIF['StripOffsets']);
            unset($EXIF['StripByteCounts']);

            $tiffinfo = $this->tiff($EXIF, $fname);

            $printfile = new PrintFile;
            $printfile->name = $file->getClientOriginalName();
            $printfile->extension = $file->getClientOriginalExtension();
            $printfile->filename = $fname;
            $printfile->size = $storage->size($fname);
            $printfile->user_id = auth()->user()->id;
            $printfile->width = $tiffinfo['width']['data'];
            $printfile->height = $tiffinfo['height']['data'];
            $printfile->resolution = $tiffinfo['resolution']['data'];
            $printfile->mimetype = $tiffinfo['mimetype']['data'];
            $printfile->save();

            return $tiffinfo;
            //return ['fname'=>$printfile->filename, $tiffinfo];
        });
    }





    public function commands($command, $obj, $var = null, $newname = null)
    {   
        

        if($command == 'check') {
            $json_url = "http://".$obj->login."@".$obj->remote_ip.":".$obj->web_remote_port;
            $json = file_get_contents($json_url);
            $data = json_decode($json, TRUE);
            $df = trim(end($data['df']));
            $pcent = $df*1;
               if($pcent <= 90) {
                 $obj->$command = true;
             } else {
                $obj->$command = false;
            }
        }

        if($command == 'df') {
            exec("ssh ".$obj->login."@".$obj->remote_ip." df -hl --total --output=pcent", $output);
            $obj->$command = trim(end($output))*1;
        }

        if($command == 'scp') {
            exec("scp ".$var." ".$obj->login."@".$obj->remote_ip.":~/".$obj->web_remote_dir."/".$newname." >/dev/null 2>/dev/null &");
        }

        return $obj;
    }

    public function slugify($string) {
        $string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
        $string = preg_replace('/[-\s]+/', '-', $string);
        return trim($string, '-');
    }

    public function printfile($localfile)
    {
        $data[] = $localfile->order->user_id;
        $data[] = $localfile->order->id;
        $data[] = $localfile->order->width.'x'.$localfile->order->height;
        $data[] = $localfile->order->count;
        $data[] = $this->slugify($localfile->order->typevar->type->title);
        $data[] = $this->slugify($localfile->order->typevar->variable->title);
        if($localfile->order->side == 2) { $data[] =  'side-2'; } 
        $res = implode("-", $data);
        return $res.'.tif'; 
    }

    public function send2server($id)
    {

            $server = Servers::first();

            $this->commands('check', $server);
            
            if(!$server->check) {
                return response('Сервер '.$server->login.'@'.$server->remote_ip.' не отвечает или закончилось дисковое пространство', 401);
            }
            
            $localfile = PrintFile::find($id);
            if(!$localfile) {
                return response('Файла нет в базе', 401);
            }

            $file =  Storage::disk('print')->exists($localfile->filename);
            if(!$file) {
                return response('Файла нет в storage', 401);
            }

            $localfile->server_id = $server->id;
            $newname = $this->printfile($localfile);
            $localfile->printfile = $newname;
            $localfile->save();


            $filepath = storage_path('print/'.$localfile->filename); 
            $this->commands('scp', $server, $filepath, $newname);
            return response('Файл отправлен', 200);
    }

}