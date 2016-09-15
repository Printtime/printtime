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
		<p>Название: {!! $order->title !!}</p>
		<p>Комментарий: {!! $order->comment !!}</p>
		<p>Дата: {!! $order->created_at !!}</p>

		@if(count($order->getPostpress) >= 1)
			<h3>Постработы</h3>
			@foreach($order->getPostpress as $postpress)
			<p>{!! $postpress->label !!}: {!! $postpress_data[$postpress->name][$postpress->pivot->var] !!}</p>
			@endforeach
		@endif
	</div>

	<div class="col-sm-6 col-md-6">
		@foreach($order->files as $file)
			<h3>Сторона {!! $file->side !!}</h3>
			<p>Название: {!! $file->name !!} | ID:{!! $file->id !!}</p>
			<p>Расширение: {!! $file->extension !!}</p>
			<p data-toggle="tooltip" data-placement="left" title="{{ $file->size }} байт">Размер файла: {{ Helper::human_filesize($file->size) }}</p>
			
			<p>
			@if($file->server and $file->confirmed)
			
				<a class="btn btn-primary btn-sm" href="http://{!! $file->server->remote_ip !!}:{!! $file->server->web_remote_port !!}/{!! $file->server->web_remote_dir !!}/{!! $file->filename !!}"><span class="glyphicon glyphicon-download"></span> Скачать удаленно</a>
			@else
				Файл загружается...
			@endif
			</p>
			

		@endforeach
	</div>

</div>
</div>

@endsection
