@extends('layouts.app')

@section('content')

<script type="text/javascript">
  

$(function(){

});



</script>

<div class="container">
<h1>{{ $typevar->type->title }}</h1>
<h3>{{ $typevar->variable->title }}</h3>

<div class="hidden" id="price">{{ $typevar->price }}</div>

<div class="row">
	<div class="col-sm-12">
	<br>
{{ Form::open(array('route' => array('order.save', $typevar->id))) }}




  <div class="form-group">
    <label for="title">Название заказа</label>
    <input value="{{ old('title') }}" required="required" name="title" type="text" class="form-control" id="title" placeholder="Укажите название заказа">
  </div>

<label>Макет</label>
<p>Расширения tif/tiff, субтрактивная схема формирования цвета CMYK, размер файла не более 2 Гб.</p>
<div class="row">
	@include('printfile.form')
</div>

<br>

<label>Размер и количество</label>

<div class="row">
  <div class="col-sm-4">
    <label class="sr-only" for="width">Ширина</label>
    <div class="input-group">
      <div class="input-group-addon">Ширина</div>
      <input name="width" type="number" step="1" class="calc form-control text-center input-lg" id="width" value="1000">
      <div class="input-group-addon"> мм.</div>
    </div>
  </div>
  <div class="col-sm-4">
    <label class="sr-only" for="height">Высота</label>
    <div class="input-group">
      <div class="input-group-addon">Высота</div>
      <input name="height" type="number" step="1" class="calc form-control text-center input-lg" id="height" value="1000">
      <div class="input-group-addon"> мм.</div>
    </div>
  </div>

  <div class="col-sm-4">
    <label class="sr-only" for="count">Количество</label>
    <div class="input-group">
      <div class="input-group-addon">Количество</div>
      <input name="count" type="number" min="1" class="calc form-control text-center input-lg" id="count" value="1">
      <div class="input-group-addon"> шт.</div>
    </div>
  </div>
</div>

<br>
@if($postpressview)
  @foreach($postpressview as $view)
    @include($view->view)
  @endforeach
@endif



<br>

<label>Комментарий к заказу</label>
<textarea name="comment" class="form-control" rows="3" placeholder="Если необходимо, прокомментируйте детали заказа..."></textarea>

<br>

<table class="table table-striped">
<tr>
	<td>Печать</td>
	<td><span id="print">{{ $typevar->price }}</span> грн. (<span id="area">1.00</span> м2)</td>
</tr>
<tr>
	<td>Постработы</td>
	<td><span id="PricePostpress">0.00</span> грн.</td>
</tr>
<tr>
	<td>Доставка</td>
	<td>Самовывоз со склада Printtime</td>
</tr>
<tr>
	<td>Ваша скидка <span id="discount">{{ Auth::user()->discount }}</span>%</td>
	<td>Экономия <span id="economy">{{ $typevar->price * Auth::user()->discount / 100 }}</span> грн.</td>
</tr>
<tr>
	<td>Ваша баланс</td>
	<td><span id="balance">{{ Auth::user()->balance }}</span> грн. (<a href="{!! route('user.transfer') !!}" class="ajax-pay" data-toggle="modal" data-target="#open-modal-pay">Пополнить баланс</a>)</td>
</tr>
<tr>
	<td>Итого к оплате</td>
	<td><b id="sum">{{ $typevar->price - $typevar->price * Auth::user()->discount / 100 }}</b> грн.</td>
</tr>
</table>

     <input id="sumPay" type="hidden" name="sum" value="{{ $typevar->price - $typevar->price * Auth::user()->discount / 100 }}">

{!! Form::submit('Оплатить и оформить заказ', ['class' => 'btn btn-success btn-lg']) !!}

{!! Form::close() !!}

	</div>
</div>
</div>

@endsection
