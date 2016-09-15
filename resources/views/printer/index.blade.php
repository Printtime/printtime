@extends('printer.app')

@section('content')


<div class="container-fluid">
<div class="row">


<div class="col-sm-10 col-md-10 col-sm-offset-1">

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
			<th>Постработы</th>
			<th>Файлы</th>
		</tr>
	</thead>
	<tbody>

@foreach($orders as $order)
		<tr>
			<td>{{ $order->id }}</td>
			<td>@if($order->comment) <a href="#" data-toggle="tooltip" data-html="true" title="<i>{!! $order->title !!}</i><br>{!! $order->comment !!}"><span class="glyphicon glyphicon-flag"></span></a> @endif</td>

			<td>
				<a href="{!! route('printer.show', ['id' => $order->id]) !!}">{{ $order->typevar->type->title }}, {{ $order->typevar->variable->title }}</a>
				<br>
				<a class="btn btn-xs btn-default @if($order->status_id == '3') btn-success @endif btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '3']) !!}">Готово</a>
				<a class="btn btn-xs btn-default @if($order->status_id == '4') btn-success @endif btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '4']) !!}">На складе</a>
				<a class="btn btn-xs btn-default @if($order->status_id == '5') btn-success @endif btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '5']) !!}">Отправлено</a>
				<a class="btn btn-xs btn-danger @if($order->status_id == '6') btn-success @endif btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '6']) !!}">Получено</a>
				
			</td>

			<td>{!! $order->width !!}</td>
			<td>{!! $order->height !!}</td>
			<td>{!! $order->created_at !!}</td>
			<td>{!! $order->count !!}</td>

			<td>@if($order->getPostpress)
				@foreach($order->getPostpress as $postpress)
					{!! $postpress->label !!}: {!! $postpress_data[$postpress->name][$postpress->pivot->var] !!}<br>
				@endforeach
			@endif</td>

			
			<td>
				@foreach($order->files as $file)
					@if($file->server and $file->confirmed)
						<a class="btn btn-success btn-sm" href="http://{!! $file->server->local_ip !!}:{!! $file->server->web_local_port !!}/{!! $file->server->web_local_dir !!}/{!! $file->filename !!}"><span class="glyphicon glyphicon-download"></span> Local</a>
						<a class="btn btn-primary btn-sm" href="http://{!! $file->server->remote_ip !!}:{!! $file->server->web_remote_port !!}/{!! $file->server->web_remote_dir !!}/{!! $file->filename !!}"><span class="glyphicon glyphicon-download"></span> Web</a><br>
					@endif
				@endforeach
			</td>
		</tr>
@endforeach
	</tbody>
</table>


<center>{{ $orders->links() }}</center>

</div>
</div>
</div>

@endsection
