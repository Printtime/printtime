@extends('layouts.app')

@section('content')

  <div class="container gal-container">

  <h1>Наши работы</h1>
    	@foreach($catalogs as $catalog)
    	<h2>{!! $catalog->title !!}</h2>
    	<div class="gal-row">
			@foreach($catalog->photo as $photo)
			    <div class="col-md-4 col-sm-6 co-xs-12 gal-item">
			      <div class="box">
			        <a title="{{ $catalog->title }}" href="{!! route('catalog.show', ['catalog' => $catalog->id]) !!}">
			          <img alt="{{ $catalog->title }}" src="{!! $photo !!}">
			        </a>
			      </div>
			    </div>
			@endforeach
		 </div>
    	@endforeach
</div>

@endsection
