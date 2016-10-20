

@if($duplex)
	2 file
@else
	1 file
@endif


	<hr>

@foreach($postpress_views as $postpress_view)
	{{ $postpress_view->id }}
	<br>
	{{ $postpress_view->name }}
	<br>
	{{ $postpress_view->label }}
	<br>
	{{ $postpress_view->f }}
	<br>
	{{ $postpress_view->view }}
	<hr>
@endforeach