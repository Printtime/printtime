
@if($order->typevar->type->product->order_vis)
	2 file
@else
	1 file
@endif


	<hr>

@foreach($order->typevar->type->product->postpresss as $postpress_view)

	{{ $postpress_view->name }}
	{!! Form::select($postpress_view->name, $postpress_view->getData(), $order->getPostpressArr()) !!}

	{{ $postpress_view->id }}
	<br>
	
	<br>
	{{ $postpress_view->label }}
	<br>
	{{ $postpress_view->f }}
	<br>
	{{ $postpress_view->view }}
	<hr>
@endforeach