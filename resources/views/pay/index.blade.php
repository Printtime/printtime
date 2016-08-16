@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">


<table class="table table-hover">

	<thead>
		<tr>
			<th>Номер счета</th>
			<th>Сумма</th>
			<th>Статус</th>
			<th>Тип операции</th>
			<th>Дата и время</th>
		</tr>
	</thead>
	<tbody>


	@foreach($pays as $pay)
	<tr>
		<td>{!! $pay->id !!}</td>
		<td>{!! $pay->amount !!}</td>
		<td>{!! $pay->status !!}</td>
		<td>{!! $pay->type !!}</td>
		<td>{!! $pay->created_at !!}</td>
	</tr>

	@endforeach

	</tbody>
</table>

<center>{{ $pays->links() }}</center>

</div>
</div>
</div>

@endsection


