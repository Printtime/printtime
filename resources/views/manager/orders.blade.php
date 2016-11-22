@extends('manager.app')


@section('content')

<div class="container-fluid">
<div class="row">

<div class="col-sm-12 col-md-10 col-md-offset-1 col-sm-offset-0">

<h3>Все заказы</h3>

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>№</th>
			<th></th>
			<th>Пользователь</th>
			<th>Тип</th>
			<th>Параметр</th>
			<th>Сумма</th>
			<th>Дата и время</th>
			<th>Статус</th>
		</tr>
	</thead>
	<tbody>

@foreach($orders as $order)
		<tr>
			<td><a>{{ $order->id }}</a></td>
			<td>@if($order->comment) <a href="#" data-toggle="tooltip" data-html="true" title="<i>{!! $order->title !!}</i><br>{!! $order->comment !!}"><span class="glyphicon glyphicon-flag"></span></a> @endif</td>
			<td><a>{{ $order->name }}</a></td>
			<td>{{ $order->type }}</td>
			<td>{{ $order->var }}</td>
			<td>{{ $order->sum }}</td>
			<td>{!! $order->created_at !!}</td>
			<td><span class="label label-default status{{ $order->status_id }}">{{ $order->status }}</span></td>
		</tr>
@endforeach
	</tbody>
</table>


<center>{{ $orders->links() }}</center>

</div>
</div>
</div>

@endsection