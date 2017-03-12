@extends('printer.app')

@section('content')


<div class="container-fluid">
<div class="row">

<div class="col-sm-12 col-md-10 col-md-offset-1 col-sm-offset-0">
<h3>Пользователи</h3>

<table class="table table-hover">
<thead>
	<tr>
		<th>ID</th>
		<th>Ф.И.О.</th>
		<th>E-mail</th>
		<th>Телефон</th>
		<th>Скидка</th>
		<th>Кред.лимит</th>
		<th>Заказов</th>
	</tr>
</thead>
@foreach($users as $user)
	<tr @if($user->balance < 0) class="danger" @endif>
		<td>{{ $user->id }}</td>
		<td><a href="{{ route('printer.user.orders', ['user_id' => $user->id]) }}">{{ $user->name }}</a></td>
		<td>{{ $user->email }}</td>
		<td>{{ $user->phone }}</td>
		<td>{{ $user->discount }}%</td>
		<td>{{ $user->credit }}</td>
		<td>{{ $user->orders_count }}</td>
	</tr>
@endforeach
</table>

<center>{{ $users->links() }}</center>

</div>
</div>
</div>

@endsection
