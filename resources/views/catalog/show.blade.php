@extends('layouts.app')

@section('content')

<div class="container catalog">
    <div class="row">

            <div class="col-md-4">
                @foreach ($catalogs as $item)
                    @if($catalog->id == $item->id)
                    	<h3>{!! link_to_route('catalog.show', $item->title, $item->id, ['class'=>'active']) !!}</h3>
	                    @foreach ($item->products as $product)
	                        {!! link_to_route('product.show', $product->title, $product->id) !!}<br>
	                    @endforeach
                    @else
                    	<h3>{!! link_to_route('catalog.show', $item->title, $item->id) !!}</h3>
                    @endif
                @endforeach
            </div>


    </div>
</div>

<div class="container page">
    <div class="row">
        <div class="col-md-12">
			<h1>{!! $catalog->title !!}</h1>
			{!! $catalog->content !!}
			@foreach($catalog->photo as $photo)
				<img src="/{!! $photo !!}">
			@endforeach
        </div>
    </div>
</div>


@endsection
