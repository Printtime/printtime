@extends('designer.app')
@section('content')

<div class="container">
<div class="row">

	<div class="col-sm-6 col-md-6">
		<h3>Заказ №{!! $order->id !!}</h3>
		<p>Товар: {{ $order->typevar->type->title }}</p>
		<p>Параметр: {{ $order->typevar->variable->title }}</p>
		<p>Ширина: {{ $order->width }} мм</p>
		<p>Высота: {{ $order->height }} мм</p>
		<p>Название: {!! $order->title !!}</p>
		<p>Комментарий: {!! $order->comment !!}</p>
		<p>Дата: {!! $order->created_at !!}</p>
		@if($order->status_id == 1)
		<p>
				<a class="btn btn-success btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '2']) !!}">Подтвердить</a>
				<a class="btn btn-danger btn-sm" href="{!! route('order.status', ['id' => $order->id, 'status' => '7']) !!}">Отменить</a>
		</p>
		@else
		<p>Статус: {!! $order->status->title !!}</p>
		@endif
	</div>

	<div class="col-sm-6 col-md-6">
		@foreach($order->files as $file)
			<h3>Сторона {!! $file->side !!}</h3>
			<p>Название: {!! $file->name !!}</p>
			<p>Расширение: {!! $file->extension !!}</p>
			<p data-toggle="tooltip" data-placement="left" title="{{ $file->size }} байт">Размер файла: {{ Helper::human_filesize($file->size) }}</p>
			<p>{!! $file->filename !!}</p>
			<p>
				<a class="btn btn-primary btn-sm" href="{!! route('printfile.download', ['id' => $file->id, 'server' => 'local']) !!}"><span class="glyphicon glyphicon-download"></span> Скачать</a>


<a href="{!! route('printfile.send2server', ['id' => $file->id]) !!}" class="btn btn-warning btn-sm send2server" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Отправка..."><span class="glyphicon glyphicon-upload"></span> Отправить в печать</a>

			</p>
		@endforeach
	</div>

</div>
</div>
@endsection
