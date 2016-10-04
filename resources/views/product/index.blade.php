@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	@foreach($catalogs as $catalog)
    		<div class="col-xs-12 col-sm-6 col-md-4 text-center">
	    		<div class="catalog-block">
	    		<a href="{!! route('products.product_all', $catalog->id) !!}" title="{!! $catalog->id !!}">
	    			<img class="img-circle" src="{!! $catalog->avatar !!}">
	    			<div class="catalog-info">
		    			<h2>{!! $catalog->title !!}</h2>
		    			<p>Закажи @foreach($catalog->products  as $product) {{ $product->title }}, @endforeach прямо сейчас!</p>
		    			<p><a class="btn btn-success btn-lg" style="color:#fff;" href="{!! route('products.product_all', $catalog->id) !!}" title="{!! $catalog->id !!}"><span class="glyphicon glyphicon-shopping-cart"></span> Заказать</a></p>
	    			</div>
	    		</a>
	    		</div>
    		</div>
    	@endforeach
    </div>
</div>
@endsection
