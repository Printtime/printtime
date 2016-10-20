@extends('layouts.app')

@section('content')
<div class="container">
<h1>Мои заказы</h1>

<table class="table table-hover table-striped">

<thead>
	<tr>
		<th>№</th>
		<th>Название</th>
		<th>Статус</th>
		<th>Тип заказа</th>
		<th>Кол-во</th>
		<th>Дата</th>
		<th>Цена</th>
		<th>Оплата</th>
	</tr>
</thead>

<tbody>
@foreach($orders as $order)
	<tr>
		<td>{{ $order->id }}</td>
		<td><a href="{{ route('order.show', $order->id) }}">{{ $order->title }}</a></td>
		<td><span class="label label-default status{{ $order->status->id }}">{{ $order->status->title }}</span></td>
		<td class="small">{{ $order->typevar->type->title }}, {{ $order->typevar->variable->title }}</td>
		<td>{{ $order->count }}</td>
		<td class="small">{{ $order->created_at }}</td>
		<td>{{ $order->sum }}</td>
		<td>@if($order->status->id == '8') <a href="{{ route('pay.orderPay', $order->id) }}" class="label label-default statusGreen ajax-pay" data-toggle="modal" data-target="#open-modal-pay">Оплатить</a> @else <span class="label label-default status0">Оплачен</span> @endif</td>
	</tr>
@endforeach
</tbody>

</table>

<center>{{ $orders->links() }}</center>

</div>
@endsection
