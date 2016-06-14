@extends('layouts.app')

	@section('page')



<div class="container page">
    <div class="row">
        <div class="col-md-12">
			<h1>{!! $page->title !!}</h1>
			{!! $page->text !!}
        </div>
    </div>
    </div>

	@endsection


@section('content')
<div class="container catalog">
    <div class="row">
    	@foreach($catalogs as $catalog)
    		<div class="col-xs-12 col-sm-6 col-md-4 text-center">
	    		<div class="catalog-block">
	    		<a href="{!! route('catalog.show', ['catalog' => $catalog->id]) !!}">
	    			<img class="img-circle" src="{!! $catalog->avatar !!}">
	    			<div class="catalog-info">
		    			<h2>{!! $catalog->title !!}</h2>
		    			<p>{!! $catalog->description !!}</p>
	    			</div>
	    		</a>
	    		</div>
    		</div>
    	@endforeach
    </div>
</div>
@endsection
