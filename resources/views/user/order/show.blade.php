@extends('layouts.app')

@section('content')


<div class="container">
<div class="row">

	<div class="col-sm-6 col-md-6">
		<h3>Заказ №{!! $order->id !!}</h3>
		<p><span class="label label-default status{{ $order->status->id }}">{{ $order->status->title }}</span></p>
		<p>Товар: {{ $order->typevar->type->title }}</p>
		<p>Параметр: {{ $order->typevar->variable->title }}</p>
		<p>Ширина: {{ $order->width }} мм</p>
		<p>Высота: {{ $order->height }} мм</p>
		<p>Площадь одного изделия: {{ $order->width/1000*$order->height/1000 }} м2</p>
		<p>Количество: {{ $order->count }} шт.</p>
		<p>Название: {!! $order->title !!}</p>
		<p>Комментарий: {!! $order->comment !!}</p>
		<p>Дата: {!! $order->created_at !!}</p>

		@if(count($order->getPostpress) >= 1)
			<h3>Постработы</h3>

				@foreach($order->getPostpress as $postpress_view)
						<p>{!! $postpress_view->label !!}: {{ $postpress_view->getData()[$postpress_view->pivot->var] }}</p>
				@endforeach
				
		@endif


	</div>

	<div class="col-sm-6 col-md-6"> 
		@foreach($order->files as $file)
			@if(auth()->user()->id == $file->user_id)
				<h3>Сторона {!! $file->side !!}</h3>
				<div class="text-center thumbnail"><img src="{{ route('system.tiff2jpg', ['filename' => $file->filename]) }}"></div>
				<p>Название: {!! $file->name !!} | ID:{!! $file->id !!}</p>
				<p>Расширение: {!! $file->extension !!}</p>
				<p data-toggle="tooltip" data-placement="left" title="{{ $file->size }} байт">Размер файла: {{ Helper::human_filesize($file->size) }}</p>
				
<!-- 				<p>
				@if($file->server and $file->confirmed)
					<a class="btn btn-primary btn-sm" href="http://{!! $file->server->remote_ip !!}:{!! $file->server->web_remote_port !!}/{!! $file->server->web_remote_dir !!}/{!! $file->filename !!}"><span class="glyphicon glyphicon-download"></span> Скачать удаленно</a>
				@else
					Файл загружается...
				@endif
				</p> -->
				
			@endif
		@endforeach
		<h3 class="text-right">Сумма: <strong>{{ $order->sum }}</strong> грн.</h3>
	</div>

	<div class="col-sm-12 col-md-12 text-center">
		@if($order->status->id == 8 and count($order->files) >= 1)
			<a href="{{ route('pay.orderPay', $order->id) }}" data-toggle="modal" data-target="#open-modal-pay" class="btn btn-success ajax-pay">Оплатить заказ</a>
		@endif
		
		@if($order->status->id == 8 OR $order->status->id == 1)
			<a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning">Редактировать заказ</a>
			<a class="btn btn-danger" href="{{ route('order.delete', $order->id) }}">Удалить заказ</a>
		@endif

		@if($order->status->id == 7)
			<a href="{{ route('order.edit', $order->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-share-alt"></span> Восстановить заказ</a>
		@endif

	</div>

</div>
</div>

@endsection
