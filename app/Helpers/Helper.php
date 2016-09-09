<?php

namespace App\Helpers;

use Request;

class Helper
{


public static function setActive($path)
{
    return Request::is($path) ? ' class=active' :  '';
    #return Request::is($path.'*') ? ' class=active' :  '';
}

    public static function human_filesize($bytes, $decimals = 2)
    {
        $size = [' байт', ' Кбайт', ' Мбайт', ' GB', ' TB', ' PB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
        @$size[$factor];
    }
    
/*
public static function testsetActive($path)
{

    return "class=active";

}*/

/*
    public static function human_filesize($bytes, $decimals = 2)
    {
        $size = [' байт', ' Кбайт', ' Мбайт', ' GB', ' TB', ' PB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
        @$size[$factor];
    }


    public static function style2html($name, $style) {

        foreach ($style as $style) {

            if ($style->style == 'Bold' OR $style->style == 'Heavy' OR $style->style == 'Black') {
                $name = '<b>'.$name.'</b>';
            }

            if ($style->style == 'Italic') {
                $name = '<i>' . $name . '</i>';
            }

        }

        return $name;

    }


public static function fonts2line($array, $maxlim = null) {

    $return = '';

    $total = count($array);
    if (isset($maxlim)) { $total = $maxlim; }

    $counter = 0;
    foreach($array as $key => $value){
        $counter++;
        if($counter == $total){
            $return .= $value->id;
        }
        else{
            $return .= $value->id.'-';
        }
        if ($maxlim == $counter) { break; }
    }

    return $return;

}


    public static function CleanName($str)
    {
        return preg_replace ("/[^a-zA-Z0-9\s]/","",$str);
    }
*/

}

