@extends('layouts.app')

@section('content')


<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12">

  <div class="form-group pull-right">
    <p>Ваш кредитный лимит: {{ Auth::user()->credit }} грн.</p>
  </div>

{!! Form::open(['route' => 'user.profileUpdate']) !!}
  <div class="form-group">
    {!! Form::label('name', 'Фамилия Имя Отчество') !!}
    {!! Form::text('name', Auth::user()->name, ['id'=>'name', 'class'=>'form-control', 'required']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('phone', 'Мобильный номер телефона') !!}
    {!! Form::tel('phone', Auth::user()->phone, ['id'=>'phone', 'class'=>'form-control', 'placeholder'=>"+380", 'required']) !!}
  </div>
{{-- <div class="form-group">
    {!! Form::label('email', 'E-Mail адрес') !!}
    {!! Form::text('email', Auth::user()->email, ['id'=>'email', 'class'=>'form-control', 'required']) !!}
  </div>
  --}}
  <div class="form-group">
    {!! Form::label('password', 'Новый пароль') !!}
    {!! Form::password('password', ['id'=>'password', 'class'=>'form-control']) !!}
  </div>
  <div class="form-group">
	{{ Form::label('password_confirmation', 'Повторите новый пароль') }}
	{{ Form::password('password_confirmation', ['id'=>'password_confirmation', 'class'=>'form-control']) }}
  </div>
  <div class="form-group pull-left">
  	<small>Ваш e-mail адрес: {{ Auth::user()->email }}<br>
  	Дата регистрации: {{ Auth::user()->created_at }}</small>
  </div>
  {!!  Form::submit('Обновить профиль', ['class'=>'btn btn-primary pull-right']) !!}

{!! Form::close() !!}




</div>
</div>
</div>

@endsection
