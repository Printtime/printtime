@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">




@foreach($products as $product)
<div class="col-sm-6 col-md-3 text-center">

	<a href="{!! route('products.product', $product->id) !!}" title="{!! $product->title !!}">
	   @if($product->avatar)
	        <img class="img-responsive" src="{{ route('imagecache', ['avatarmedium', last(explode('/', $product->avatar))]) }}" alt="{{ $product->title }}">
	    @endif
	<h3>{!! $product->title !!}</h3>
	</a>
</div>
@endforeach





</div>
</div>

@endsection
