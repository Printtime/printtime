@extends('manager.app')

@section('content')


<div class="container-fluid">
<div class="row">

<div class="col-sm-12 col-md-10 col-md-offset-1 col-sm-offset-0">
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
		<td>{{ $pay->id }}</td>
		<td><a href="{{ route('manager.pays', ['user_id'=>$pay->user_id]) }}" data-toggle="tooltip" data-html="true" title="{{ nl2br($pay->description) }}">{{ $pay->name }}</a></td>
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
