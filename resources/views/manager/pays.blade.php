@extends('manager.app')

@section('content')


<div class="container">
<div class="row">

<div class="col-sm-12 col-md-12">
<h3>Платежи</h3>

<table class="table table-hover">
<thead>
	<tr>
		<th>№</th>
		<th>Пользователь</th>
		<th>action</th>
		<th>Card</th>
		<th>status</th>
		<th>type</th>
		<th>Сумма</th>
		<th>Дата</th>
	</tr>
</thead>
@foreach($pays as $pay)
	<tr>
		<td><a href="#" data-toggle="tooltip" data-html="true" title="{{ $pay->description }}">{{ $pay->id }}</a></td>
		<td>{{ $pay->name }}</td>
		<td>{{ $pay->action }}</td>
		<td>{{ $pay->sender_card_mask2 }}</td>
		<td>{{ $pay->status }}</td>
		<td>{{ $pay->type }}</td>
		<td>{{ $pay->amount }}</td>
		<td>{{ $pay->created_at }}</td>
	</tr>
@endforeach
</table>

<center>{{ $pays->links() }}</center>

</div>
</div>
</div>

@endsection
