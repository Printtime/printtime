@extends('manager.app')

@section('content')


<div class="container">
<div class="row">

<div class="col-sm-12 col-md-12">
<h3>Пользователи</h3>

<table class="table table-hover">
<thead>
	<tr>
		<th>ID</th>
		<th>Ф.И.О.</th>
		<th>E-mail</th>
		<th>Телефон</th>
		<th>Дата регистрации</th>
		<th>Баланс</th>
		<th>Скидка</th>
		<th>Заказов</th>
	</tr>
</thead>
@foreach($users as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td>{{ $user->name }}</td>
		<td>{{ $user->email }}</td>
		<td>{{ $user->phone }}</td>
		<td>{{ $user->created_at }}</td>
		<td>{{ $user->balance }}</td>
		<td>{{ $user->discount }}%</td>
		<td>{{ $user->orders_count }}</td>
	</tr>
@endforeach
</table>

<center>{{ $users->links() }}</center>

</div>
</div>
</div>

@endsection
