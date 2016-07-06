@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">

<h1>{{ $product->title }}</h1>

<div class="col-sm-12 col-md-12">
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

</div>
</div>


@endsection
