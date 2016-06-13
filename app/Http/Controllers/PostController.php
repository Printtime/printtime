<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Post;

class PostController extends Controller
{
    public function index()
    {	
        return view('post.index')->with('posts', Post::paginate(10));
    }

    public function show($id)
    {
        return view('post.show', [
        	'post' => Post::findOrFail($id)
        	]);
    }
}
