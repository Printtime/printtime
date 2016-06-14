@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-sm-12">
                @foreach($posts as $post)
                  <div class="col-xs-12 col-sm-6 col-md-4 text-center">
                        <h2><a href="{!! route('post.show', ['post' => $post->id]) !!}">{!! $post->title !!}</a></h2>
                        {!! $post->text !!}
                  </div>
                @endforeach
        </div>
  </div>
</div>

@endsection
