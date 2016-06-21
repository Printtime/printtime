<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use Image;

class ImgController extends Controller
{
    public function getCache(Request $requests)
    {		

    	#dd($requests->templates);
    	#dd($requests->segment(5));
    	#dd($requests->path);
    	#$image = Image::make($requests->path);
    	$image = $requests->path;

    	$img = Image::cache(function($image) {
		    $image->make('images/uploads/03e9bb3827c54e3030f9a5f9a82d400c.jpg')->resize(300, 200)->greyscale();
		});

    	#return response()->$img;
    	return $img;
    	#return dd(public_path('images'));
    	#$img = Image::make($image);
    	#$img = file(public_path('images/uploads').'/'.$image);
    	$image_path = public_path('images/uploads').'/'.$image;
    	$image = Image::make($image_path);
    	#return dd($img);

    	#$image = Image::make(public_path().'/images/uploads/'.$imgname)->resize(300, 200)->save(public_path().'/images/uploads_cache/'.$imgname);
		$img = Image::cache(function($image) {
		    $image->resize(300, 200)->greyscale();
		});

		return dd($img);

    	return response()->file(public_path().'/images/uploads/'.$imgname);
    	$img = Image::canvas(800, 600, '#000ccc');
    	return response()->$img;
    	return dd($img);
    	return response()->file($pathToFile);
		$image = Image::make(public_path().'/images/uploads/'.$imgname);

    	#return dd($image);
		$img = Image::cache(function($image) {
		   $image->make('public/foo.jpg')->resize(300, 200)->greyscale();
		}, 10, true);

    	return dd($img);

    	$img = Image::canvas(800, 600, '#000ccc');
    	return $img;
    $img = Image::make('foo.jpg')->resize(300, 200);

    return $img->response('jpg');
/*
    	$image = File::get(public_path().'/images/uploads/'.$imgname);
    	#dd($image);
 		return $image->resize(300, 200)->greyscale();

			$img = Image::cache(function($image) {
			   return $image->make(public_path().'/images/uploads_cache/test.jpg')->resize(300, 200)->greyscale();
			});
*/
        #return view('page.show')->with('page', Page::find($id));
    }
}
