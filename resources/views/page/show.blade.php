@extends('layouts.app')

@section('content')
<div class="container">
<h1>{!! $page->title !!}</h1>
<div class="row">

<div class="col-sm-12">
	@if(isset($page->avatar))	
	<img class="img-thumbnail pull-left" width="50%" style="margin-right: 20px; margin-bottom: 20px;" src="{{ $page->avatar }}" alt="{{ $page->title }}">
	@endif
	
	{!! $page->text !!}
</div>

		@if($page->photo)	
            @foreach($page->photo as $photo)
            <div class="col-sm-3 col-md-4">
                <a class="thumbnail" href="{!! $photo !!}" data-lightbox="photo"><img src="{{ route('imagecache', ['photoedium', last(explode('/', $photo))]) }}" alt="{!! $page->title !!}"></a>
            </div>
            @endforeach
           @endif
</div>

	@if($page->get_sub_pages)	
		@foreach($page->get_sub_pages as $pages)
		<hr>

		<div class="row">
			<div class="col-sm-4">
					       <a style="cursor: pointer;" href="{{ route('page.show', $pages->id) }}" class="hovereffect"><img class="img-responsive" src="{{ $pages->avatar }}" alt="{{ $pages->title }}"></a>
			</div>
			<div class="col-sm-8">
				<h3><a href="{{ route('page.show', $pages->id) }}">{{ $pages->title }}</a></h3>
				<p>{!! nl2br($pages->description) !!}</p>
			</div>
		</div>
		@endforeach
	@endif


</div>

@endsection
