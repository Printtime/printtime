@extends('layouts.app')

@section('catalog')




<div class="col-sm-8 col-md-9">
<h1>{{ $product->title }}</h1>

   @if($product->avatar)
		<img class="img-thumbnail pull-left" src="{{ route('imagecache', ['avatarmedium', last(explode('/', $product->avatar))]) }}" alt="{{ $product->title }}">

    @endif

{!! $product->content !!}
</div>

            @foreach($product->photo as $photo)
            <div class="col-sm-3 col-md-4">
                <a class="thumbnail" href="{!! $photo !!}" data-lightbox="photo"><img src="{{ route('imagecache', ['photoedium', last(explode('/', $photo))]) }}" alt="{!! $product->title !!}"></a>
            </div>
            @endforeach



@endsection
