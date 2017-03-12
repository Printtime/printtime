@extends('printer.app')


@section('user')
	@if(isset($user))
		<div class="container" style="margin-bottom: 20px">
		<div class="row">
		<div class="col-sm-12">
		<h3>{{ $user->name }}</h3>
		<small>Телефон: {{ $user->phone }}, e-maiL: {{ $user->email }}</small>
		</div></div></div>
	@endif
@endsection

@section('content')

<meta http-equiv="refresh" content="600">

<div class="container-fluid">
<div class="row">

<div class="col-sm-12 col-md-8 col-md-offset-2 col-sm-offset-0">

	@foreach($orders->groupBy('type_var_id') as $group)


<table class="table table-hover">
	<thead style="background: #efefef;">
		<tr>
			<th width="32px">Клиент</th>
			<th width="32px">Заказ</th>
			<th width="32px"></th>
			<th width="32px"></th>
			<th width="360px">{{ $group->first()->typevar->type->title }}<br>{{ $group->first()->typevar->variable->title }}</th>
			<th width="48px">Ш</th>
			<th width="48px">В</th>
			<th width="200px">Дата и время</th>
			<th width="80px">Кол-во</th>
			<th>Файлы</th>
		</tr>
	</thead>
	<tbody>

@foreach($group as $order)
		<tr>
			<td><a href="{{ route('printer.user.orders', ['user_id' => $order->user_id]) }}" data-toggle="tooltip" data-html="true" title="{{ $order->user->name }}">{{ $order->user_id }}</a></td>
			<td>{{ $order->id }}</td>
			<td>@if($order->comment) <a data-toggle="tooltip" data-html="true" title="<i>{!! $order->title !!}</i><br>{!! $order->comment !!}"><span class="glyphicon glyphicon-flag"></span></a> @endif</td>

			<td>@if(count($order->getPostpress) >= 1)

				<span data-toggle="tooltip" data-html="true" title="@foreach($order->getPostpress as $postpress)
					<i>{!! $postpress->label !!}</i>: {{ $postpress->getData()[$postpress->pivot->var] }}<br>
				@endforeach"><span class="glyphicon glyphicon-scissors"></span></span>


			@endif</td>

			<td>
				<small>Текущее состояние: {{ $order->status->title }}</small><br>
				<a class="btn btn-xs btn-default @if($order->status_id == '9') btn-success status{{ $order->status_id }} no-border @endif btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '9']) !!}">В печати</a>
				<a class="btn btn-xs btn-default @if($order->status_id == '3') btn-success status{{ $order->status_id }} no-border @endif btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '3']) !!}">Готово</a>
				<a class="btn btn-xs btn-default @if($order->status_id == '4') btn-success status{{ $order->status_id }} no-border @endif btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '4']) !!}">На складе</a>
				<a class="btn btn-xs btn-default @if($order->status_id == '5') btn-success status{{ $order->status_id }} no-border @endif btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '5']) !!}">Отправлено</a>
				
			</td>

			<td>{!! $order->width !!}</td>
			<td>{!! $order->height !!}</td>
			<td>{!! $order->created_at !!}</td>
			<td>{!! $order->count !!}</td>

			
			<td>
				@foreach($order->printerfiles as $file)
				
					@if($file->server and $file->confirmed)
						
						@if($file->printfile)
							<a class="btn btn-success btn-sm" href="http://{!! $file->server->local_ip !!}:{!! $file->server->web_local_port !!}/{!! $file->server->web_local_dir !!}/{!! $file->printfile !!}">
								<span class="glyphicon glyphicon-download"></span> {{ $file->side }}
							</a>
							@else
							<a class="btn btn-primary btn-sm" href="http://{!! $file->server->local_ip !!}:{!! $file->server->web_local_port !!}/{!! $file->server->web_local_dir !!}/{!! $file->filename !!}">
								<span class="glyphicon glyphicon-download"></span> {{ $file->side }}
								
							</a>
						@endif

						@endif
				@endforeach
			</td>
		</tr>
@endforeach

	</tbody>
</table>
	@endforeach




<center>{{ $orders->links() }}</center>


</div></div></div>
@endsection
