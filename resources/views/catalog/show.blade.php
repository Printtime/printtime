@extends('layouts.app')

@section('catalog')


        <div class="col-sm-8 col-md-9">
                <h1>{!! $catalog->title !!}</h1>
                <div class="row">
                    @foreach($catalog->products as $product)

<div class="col-sm-12">
 <div class="thumbnail">
   @if($product->avatar)
    <div class="hovereffect">
        
        <img class="img-responsive" src="{{ route('imagecache', ['avatarmedium', last(explode('/', $product->avatar))]) }}" alt="{{ $product->title }}">
        <div class="overlay">
           <h2>{{ $product->title }}</h2>
           {!! link_to_route('product.order', 'Заказать просчет', ['product'=> $product->id], ['class'=>'info btn-send ajax', 'data-toggle'=>'modal', 'data-target'=>'#open-modal']) !!}

        </div>

    </div>
    @endif
    <div class="caption">
<h3>{!! link_to_route('catalog.product.show', $product->title, [$catalog->id, $product->id]) !!}</h3>
 <p>{!! str_limit($product->description, 240) !!}</p>
</div>
</div></div>
                    @endforeach
                </div>
        </div>



@endsection

@section('content')

<div class="container">
  <div class="row">
             <div class="col-sm-12 col-md-12">
             {!! $catalog->content !!}
             </div>
            @foreach($catalog->photo as $photo)
            <div class="col-sm-3 col-md-4">
                <a class="thumbnail" href="{!! $photo !!}" data-lightbox="photo"><img src="{{ route('imagecache', ['photoedium', last(explode('/', $photo))]) }}" alt="{!! $catalog->title !!}"></a>
            </div>
            @endforeach
  </div>
  </div>

@endsection
