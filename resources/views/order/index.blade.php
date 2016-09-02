@extends('layouts.app')

@section('content')
<div class="container">
<h1>Мои заказы</h1>

<table class="table table-hover table-striped">

<thead>
	<tr>
		<th>№</th>
		<th>Название</th>
		<th>Цена</th>
		<th>Статус</th>
		<th>Тип заказа</th>
		<th>Кол-во</th>
		<th>Дата</th>
	</tr>
</thead>

<tbody>
@foreach($orders as $order)
	<tr>
		<td>{{ $order->id }}</td>
		<td>{{ $order->title }}</td>
		<td>{{ $order->sum }}</td>
		<td><span class="label label-default status{{ $order->status->id }}">{{ $order->status->title }}</span></td>
		<td>{{ $order->typevar->type->title }}, {{ $order->typevar->variable->title }}</td>
		<td>{{ $order->count }}</td>
		<td>{{ $order->created_at }}</td>
	</tr>
@endforeach
</tbody>

</table>

<center>{{ $orders->links() }}</center>

</div>
@endsection
