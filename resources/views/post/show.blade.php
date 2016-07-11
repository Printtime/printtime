@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">

          <h1>{!! $post->title !!}</h1>
          
@if($post->avatar)


<div class="col-xs-12 col-md-3">
  <span class="thumbnail"><img src="{{ route('imagecache', ['avatarmedium', last(explode('/', $post->avatar))]) }}" alt="{!! $post->title !!}"></span>
</div>

<div class="col-xs-12 col-md-9">
  <time>{!! $post->created_at !!}</time>
  <p>{!! $post->text !!}</p>
</div>

@else

<div class="col-xs-12 col-md-12">
  <time>{!! $post->created_at !!}</time>
  <p>{!! $post->text !!}</p>
</div>

@endif 


</div>



<div class="row">

            @foreach($post->photo as $photo)
            <div class="col-sm-3 col-md-4">
                <a class="thumbnail" href="{!! $photo !!}" data-lightbox="photo"><img src="{{ route('imagecache', ['photoedium', last(explode('/', $photo))]) }}" alt="{!! $post->title !!}"></a>
            </div>
            @endforeach

</div>


</div>


@endsection
