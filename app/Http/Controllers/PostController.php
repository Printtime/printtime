<?php

namespace App\Http\Controllers;

use Gate;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Post;

class PostController extends Controller
{
    public function index()
    {	
        return view('post.index')->with('posts', Post::orderBy('created_at', 'desc')->paginate(10));
    }

    public function show($id)
    {

        $post = Post::findOrFail($id);

/*
        if (Gate::allows('read-post', $post)) {
            abort(403);
        }*/

        return view('post.show', [
        	'post' => $post
        	]);
    }
}
