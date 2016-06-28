@extends('layouts.app')

@section('content')

<div class="container">


          <h1>Новости и события</h1>
          
@foreach ($posts as $k => $post)

    @if ($k % 2 == 0)
      @include('post.row', ['post' => $post, 'class_img' => 'col-xs-12 col-md-3', 'class_data' => 'col-xs-12 col-md-9'])
    @else
      @include('post.row', ['post' => $post, 'class_img' => 'col-xs-12 col-md-3 col-md-push-9', 'class_data' => 'col-xs-12 col-md-9 col-md-pull-3'])
    @endif 

@endforeach

<div class="text-center">{{ $posts->links() }}</div>

</div>

@endsection
