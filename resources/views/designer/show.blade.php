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


		<p>Статус: {!! $order->status->title !!}</p>
		
	</div>

	<div class="col-sm-6 col-md-6">

		@if(count($order->getPostpress) >= 1)
			<h3>Постработы</h3>
				@foreach($order->getPostpress as $postpress_view)
						<p>{!! $postpress_view->label !!}: {{ $postpress_view->getData()[$postpress_view->pivot->var] }}</p>
				@endforeach
		@endif

	</div>



	<div class="col-sm-12">

<h3>Файлы пользователя</h3>
<table class="table table-hover">
<thead>
	<tr>
			<th>ID</th>
			<th>Имя</th>
			<th>Размер</th>
			<th>Сторона</th>
			<th>Дата/время</th>
			<th>Владелец файла</th>
			<th>Ширина</th>
			<th>Высота</th>
			<th>DPI</th>
			<th>Скачать</th>
	</tr>
</thead>
<tbody>
		@foreach($order->files as $file)
	<tr>
			<td>{{ $file->id }}</td>
			<td>{{ $file->name }}</td>
			<td>{{ Helper::human_filesize($file->size) }}</td>
			<td>{{ $file->side }}</td>
			<td>{{ $file->created_at }}</td>
			<td>{{ $file->user->name }}</td>
			<td>{{ $file->width }} мм</td>
			<td>{{ $file->height }} мм</td>
			<td>{{ $file->resolution }}</td>
			<td>@if(Storage::disk('print')->exists($file->filename))
				<a class="btn btn-primary btn-sm" href="{!! route('printfile.download', ['id' => $file->id, 'server' => 'local']) !!}"><span class="glyphicon glyphicon-download"></span></a>@endif</td>
	</tr>
		@endforeach
</tbody>
</table>
</div>


{{ Form::open(array('route' => array('designer.update', $order->id))) }}

<div class="row">

    <input id="file0" type="hidden" name="file0">
    <input id="file1" type="hidden" name="file1">

    <div class="container"><div class="row">
        @if(isset($order->files[0])) @include('printfile.form', ['side' => '0', 'side_name'=>'Загрузить лицевую сторону']) @endif
        @if(isset($order->files[1])) @include('printfile.form', ['side' => '1', 'side_name'=>'Загрузить обратную сторону']) @endif
    </div></div>

</div>

<hr>
<center>
	{!! Form::submit('Файлы обработаны, передать заказ в печать', ['class' => 'submit btn btn-success btn-lg']) !!}
	<a class="btn btn-danger btn-lg" href="{!! route('order.status', ['id' => $order->id, 'status' => '7']) !!}">Отменить</a>
</center>

{!! Form::close() !!}




</div>
</div>
@endsection
