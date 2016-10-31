@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">

          <h1>Добавить получателя</h1>


{!! Form::model('delivery', ['route' => ['delivery.save']]) !!}

<div class="form-group">
    {{ Form::label('Фамилия Имя Отчество', null, ['class' => 'control-label']) }}
    {{ Form::text('name',null, array_merge(['class' => 'form-control'])) }}
</div>
<div class="form-group">
    {{ Form::label('Телефон', null, ['class' => 'control-label']) }}
    {{ Form::text('phone',null, array_merge(['class' => 'form-control'])) }}
</div>





<div class="form-inline">

<img src="http://www.vnutri.org/wp-content/uploads/2011/01/nova-poshta1.gif" width="16px"> {{ Form::label('Новая почта:', null, ['class' => 'control-label']) }}

<div id="city" class="form-group">
    {{ Form::text('city', null, array_merge(['class' => 'typeahead form-control', 'placeholder' => 'Введите город...'])) }}
</div>

<div id="warehouses" class="form-group">
	{{ Form::select('warehouses', [], null, ['class' => 'form-control',  'disabled', 'callback'=>'city']) }}
</div>

</div>



{!! Form::close() !!}


</div>
</div>


@endsection

