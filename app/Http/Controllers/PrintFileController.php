<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        #if($server != 'local') {
        #$server = $this->getServer($server);
        #echo $server->local.'/'.$server->dir.'/'.$localfile->filename;
        #return header('http://'.$server->local.'/'.$server->dir.'/'.$localfile->filename);
        #}
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

            $printfile = new PrintFile;
            $printfile->name = $file->getClientOriginalName();
            $printfile->extension = $file->getClientOriginalExtension();
            $printfile->filename = $fname;
            $printfile->size = $storage->size($fname);
            $printfile->save();

            return ['fname'=>$fname];
        });
    }

    // public function ServerList()
    // {
    //      $servers = (object) [
    //         's1' => (object) [
    //             'login' => 's1',
    //             'ip' => '77.239.164.37',
    //             'local' => '192.168.1.8',
    //             'dir' => 'files'
    //             ],
    //     ];

    //     return $servers;
    // }


    public function commands($command, $obj, $var = null)
    {   
        if($command == 'check') {
            exec("ssh ".$obj->login."@".$obj->remote_ip." df -hl --total --output=pcent", $output);

            $pcent= trim(end($output));
               if($pcent) {
                $free = 100 - $pcent;
                    if($free > 90) { $obj->$command = true; } else { $obj->$command = false; }
                } else { $obj->$command = false; }
        }

        if($command == 'df') {
            exec("ssh ".$obj->login."@".$obj->remote_ip." df -hl --total --output=pcent", $output);
            $obj->$command = trim(end($output))*1;
        }

        if($command == 'scp') {
            exec("scp ".$var." ".$obj->login."@".$obj->remote_ip.":~/".$obj->web_remote_dir." >/dev/null 2>/dev/null &");
        }

        return $obj;
    }
    
    // public function getServer($servername)
    // {       
    //     $server = $this->ServerList()->$servername;
    //     return $server;
    // }   


    public function send2server($id)
    {
            #$server = $this->getServer('s1');
            $server = Servers::find(1);

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
            #$localfile->confirmed = 1;
            $localfile->server_id = $server->id;
            $localfile->save();

            $filepath = storage_path('print/'.$localfile->filename); 
            $this->commands('scp', $server, $filepath);
            return response('Файл отправлен', 200);
    }

}