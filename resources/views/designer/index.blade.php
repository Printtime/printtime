@extends('designer.app')

@section('content')


<div class="container">
<div class="row">


<div class="col-sm-12 col-md-12">

<h3>Новые заказы на проверку</h3>

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>№</th>
			<th></th>
			<th></th>
			<th>Ширина (мм)</th>
			<th>Высота (мм)</th>
			<th>Дата и время</th>
			<th></th>
		</tr>
	</thead>
	<tbody>

@foreach($orders as $order)
		<tr>
			<td>{{ $order->id }}</td>
			<td>@if($order->comment) <a href="#" data-toggle="tooltip" data-html="true" title="<i>{!! $order->title !!}</i><br>{!! $order->comment !!}"><span class="glyphicon glyphicon-flag"></span></a> @endif</td>

			<td>{{ $order->typevar->type->title }}, {{ $order->typevar->variable->title }}</td>
			<td>{!! $order->width !!}</td>
			<td>{!! $order->height !!}</td>
			<td>{!! $order->created_at !!}</td>
			<td><a class="btn btn-success btn-xs" href="{!! route('designer.show', ['id' => $order->id]) !!}">Открыть</a></td>
		</tr>
@endforeach
	</tbody>
</table>


<center>{{ $orders->links() }}</center>

</div>
</div>
</div>

@endsection
