<div class="row">

@if($post->avatar)

<div class="{{ $class_img }}">
	<a href="{!! route('post.show', ['post' => $post->id]) !!}" class="thumbnail"><img src="{{ route('imagecache', ['avatarmedium', last(explode('/', $post->avatar))]) }}" alt="{!! $post->title !!}"></a>
</div>

<div class="{{ $class_data }}">
	<h2><a href="{!! route('post.show', ['post' => $post->id]) !!}">{!! $post->title !!}</a></h2>
	<time>{!! $post->created_at !!}</time>
	<p>{!! $post->text !!}</p>
</div>

@else

<div class="col-xs-12 col-md-12">
	<h2><a href="{!! route('post.show', ['post' => $post->id]) !!}">{!! $post->title !!}</a></h2>
	<time>{!! $post->created_at !!}</time>
	<p>{!! $post->text !!}</p>
</div>

@endif 

</div>