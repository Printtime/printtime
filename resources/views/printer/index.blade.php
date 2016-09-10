@extends('printer.app')

@section('content')


<div class="container">
<div class="row">


<div class="col-sm-12 col-md-12">

<h3>Заказы на печать</h3>

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>№</th>
			<th></th>
			<th>Название</th>
			<th>Ширина (мм)</th>
			<th>Высота (мм)</th>
			<th>Дата и время</th>
			<th>Количество</th>
			<th></th>
		</tr>
	</thead>
	<tbody>

@foreach($orders as $order)
		<tr>
			<td>{{ $order->id }}</td>
			<td>@if($order->comment) <a href="#" data-toggle="tooltip" data-html="true" title="<i>{!! $order->title !!}</i><br>{!! $order->comment !!}"><span class="glyphicon glyphicon-flag"></span></a> @endif</td>

			<td><a href="{!! route('printer.show', ['id' => $order->id]) !!}">{{ $order->typevar->type->title }}, {{ $order->typevar->variable->title }}</a></td>
			<td>{!! $order->width !!}</td>
			<td>{!! $order->height !!}</td>
			<td>{!! $order->created_at !!}</td>
			<td>{!! $order->count !!}</td>
			<td><span class="label label-default status{{ $order->status->id }}">{{ $order->status->title }}</span></td>
		</tr>
@endforeach
	</tbody>
</table>


<center>{{ $orders->links() }}</center>

</div>
</div>
</div>

@endsection
