@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">


        <div class="col-sm-12">

          <h1>Новости</h1>
          <p>Все события и новости нашей компании...</p>

@foreach ($posts as $k => $post)

    @if ($k % 2 == 0)
    <div class="news-row row even text-left">
                  <div class="col-xs-12 col-md-3">
                    <a href="{!! route('post.show', ['post' => $post->id]) !!}" class="thumbnail">
                      <img src="{!! $post->avatar !!}" alt="{!! $post->title !!}">
                    </a>

                  </div>
                  <div class="col-xs-12 col-md-9">
                        <h2><a href="{!! route('post.show', ['post' => $post->id]) !!}">{!! $post->title !!}</a></h2>
                        <time>{!! $post->created_at !!}</time>
                        {!! $post->text !!}
                  </div>
                  </div>
    @else
    <div class="news-row row odd text-right">
                  <div class="col-xs-12 col-md-3 col-md-push-9">
                    <a href="{!! route('post.show', ['post' => $post->id]) !!}" class="thumbnail">
                      <img src="{!! $post->avatar !!}" alt="{!! $post->title !!}">
                    </a>
                  </div>
                  <div class="col-xs-12 col-md-9 col-md-pull-3">
                        <h2><a href="{!! route('post.show', ['post' => $post->id]) !!}">{!! $post->title !!}</a></h2>
                        <time>{!! $post->created_at !!}</time>
                        {!! $post->text !!}
                  </div>
    </div>
    @endif 
@endforeach


        </div>
  </div>
</div>

@endsection
