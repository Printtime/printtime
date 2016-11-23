@extends('designer.app')
@section('content')

<div class="container">
<div class="row">

	<div class="col-sm-6 col-md-6">
		<h3>Заказ №{!! $order->id !!}</h3>
		<p><span class="label label-default status{{$order->status_id}}">{!! $order->status->title !!}</span></p>
		<p>Товар: {{ $order->typevar->type->title }}</p>
		<p>Параметр: {{ $order->typevar->variable->title }}</p>
		<p>Ширина: <b>{{ $order->width }}</b> мм</p>
		<p>Высота: <b>{{ $order->height }}</b> мм</p>
		<p>Название: {!! $order->title !!}</p>
		<p>Комментарий: <div>{!! $order->comment !!}</div></p>
		<p>Дата: {!! $order->created_at !!}</p>



		
	</div>

	<div class="col-sm-6 col-md-6">
	<h3>Заказчик</h3>
	<p>Имя: {!! $order->user->name !!}</p>
	<p>Телефон: {!! $order->user->phone !!}</p>
	<p>E-mail: {!! $order->user->email !!}</p>
	<p>Скидка: {!! $order->user->discount !!}%</p>
	<p>Баланс: {!! $order->user->balance !!} грн.</p>

		@if(count($order->getPostpress) >= 1)
			<h3>Постработы</h3>
				@foreach($order->getPostpress as $postpress_view)
						<p>{!! $postpress_view->label !!}: {{ $postpress_view->getData()[$postpress_view->pivot->var] }}</p>
				@endforeach
		@endif

	</div>



{{ Form::open(array('route' => array('designer.update', $order->id))) }}

		@foreach($order->files->groupBy('user_id') as $files)
		<div class="col-sm-12">

		@if($order->user_id == $files->first()->user_id)
			<p class="bg-success" style="padding:5px 10px">Файлы заказчика</p>
		@else
			<p class="bg-info" style="padding:5px 10px">Файлы @foreach($files->first()->user->roles as $role) | {{ $role->name }} @endforeach
			: {{ $files->first()->user->name }} ({{ $files->first()->user->phone }})</p>

			
		@endif

		<table class="table table-hover">
		<thead>
			<tr>
					<th>ID</th>
					<th><span class="glyphicon glyphicon-print"></span></th>
					<th><span class="glyphicon glyphicon-file"></span></th>
					<th>Имя</th>
					<th>Размер</th>
					<th>Дата/время</th>
					<th>Ширина</th>
					<th>Высота</th>
					<th>DPI</th>
					<th>Скачать</th>
			</tr>
		</thead>
		<tbody>
				@foreach($files as $file)
			<tr>
					<td>{{ $file->id }}</td>
					<th>{{ Form::checkbox('confirmed[]', $file->id, $file->confirmed) }}</th>
					<td>{{ $file->side }}</td>
					<td>{{ $file->name }}</td>
					<td>{{ Helper::human_filesize($file->size) }}</td>
					<td>{{ $file->created_at }}</td>
					<td>{{ $file->width }} мм</td>
					<td>{{ $file->height }} мм</td>
					<td>{{ $file->resolution }}</td>
					<td>@if(Storage::disk('print')->exists($file->filename))
						<a class="btn btn-primary btn-sm" href="{!! route('printfile.download', ['id' => $file->id, 'server' => 'local']) !!}"><span class="glyphicon glyphicon-download"></span></a>@endif

@if($file->server_id == 0 and Storage::disk('print')->exists($file->filename))
<a href="{!! route('printfile.send2server', ['id' => $file->id]) !!}" class="btn btn-warning btn-sm send2server" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Отправка..."><span class="glyphicon glyphicon-upload"></span> Отправить в цех</a>
@endif
						</td>

			</tr>
				@endforeach
		</tbody>
		</table>
		</div>
		@endforeach





<div class="col-sm-12">
<h3>Загрузка макетов дизайнера</h3>
<hr>

    <input id="file0" type="hidden" name="file0">
    <input id="file1" type="hidden" name="file1">

    <div class="container"><div class="row">
        @if(isset($order->files[0])) @include('printfile.designer_form', ['side' => '0', 'side_name'=>'Загрузить лицевую сторону']) @endif
        @if(isset($order->files[1])) @include('printfile.designer_form', ['side' => '1', 'side_name'=>'Загрузить обратную сторону']) @endif
    </div></div>
<hr>

<center>
	{!! Form::submit('Сохранить', ['class' => 'submit btn btn-success btn-lg']) !!}
	<a class="btn btn-danger btn-lg" href="{!! route('order.status', ['id' => $order->id, 'status' => '7']) !!}">Отменить</a>
</center>

</div>
{!! Form::close() !!}




</div>
</div>
@endsection
