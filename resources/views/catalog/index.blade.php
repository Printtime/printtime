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

<div class="container">
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
    		<div class="col-xs-12 col-sm-6 col-md-4 text-center">
	    		<div class="catalog-block">
	    		<a href="{!! route('page.show', ['id' => 3]) !!}">
	    			<img class="img-circle" src="/images/printer.png">
	    			<div class="catalog-info">
		    			<h2>Печатное оборудование</h2>
		    			<p>Широкоформатные принтеры - это новейшее оборудование, с помощью которого можно создавать печать как на листовых носителях, так и на рулонных, шириной до 3,2 м. с применением в интерьере и на улице. Широкоформатные принтера незаменимы при производстве различных видов рекламы: банеров, декорирования (брендирования) авто, для оформления витрин и т.п.</p>
	    			</div>
	    		</a>
	    		</div>
    		</div>
    </div>
</div>
@endsection
