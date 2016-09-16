@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
	<div class="col-sm-12 text-center">
		<h3>Что будем заказывать?</h3>
	</div>
</div>

<div class="row">


@foreach($catalogs as $catalog)
@if(count($catalog->products2order) >= 1)
	
	{{--<h2>{!! $catalog->title !!}</h2>--}}
			@foreach($catalog->products2order as $product)
				<div class="col-sm-4 col-md-4 text-center">
		<hr>
							<h2>
								<a href="{!! route('products.product', $product->id) !!}" title="{!! $product->title !!}">{!! $product->order_name !!}</a>
							</h2>
							<p>{!! $product->description !!}</p>
							<a class="btn btn-success btn-lg" href="{!! route('products.product', $product->id) !!}" title="{!! $product->order_name !!}"><span class="glyphicon glyphicon-shopping-cart"></span> Заказать</a>

							
				</div>
			@endforeach
	
@endif
@endforeach
</div>

{{-- @foreach($products as $product)
<div class="col-sm-6 col-md-3 text-center">

	<a href="{!! route('products.product', $product->id) !!}" title="{!! $product->title !!}">
	   @if($product->avatar)
	        <img class="img-responsive" src="{{ route('imagecache', ['avatarmedium', last(explode('/', $product->avatar))]) }}" alt="{{ $product->title }}">
	    @endif
	<h3>{!! $product->title !!}</h3>
	</a>
</div>
@endforeach
--}}





</div>

@endsection
