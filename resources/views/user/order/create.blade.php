@extends('layouts.app')

@section('content')

<div class="container">
<h1>{{ $value->type->title }}</h1>
<h3>{{ $value->variable->title }}</h3>


<div class="hidden" id="price">{{ $value->price }}</div>
<div class="hidden" id="coef_width">{{ $value->type->width }}</div>
<div class="hidden" id="coef_height">{{ $value->type->height }}</div>

<div class="row">
	<div class="col-sm-12">
	<br>

@if(isset($order->id))
  {{ Form::open(array('route' => array('order.update', $order->id))) }}
@else
  {{ Form::open(array('route' => array('order.save', $value->id))) }}
@endif


  <div class="form-group">
    <label for="title">Название заказа</label>
    <input value="{{ $order->title or null }}" required="required" name="title" type="text" class="form-control" id="title" placeholder="Укажите название заказа">
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
      <input name="width" type="number" step="1" class="calc form-control text-center input-lg" id="width" value="{{ $order->width or $value->type->width }}">
      <div class="input-group-addon"> мм.</div>
    </div>
  </div>
  <div class="col-sm-4">
    <label class="sr-only" for="height">Высота</label>
    <div class="input-group">
      <div class="input-group-addon">Высота</div>
      <input name="height" type="number" step="1" class="calc form-control text-center input-lg" id="height" value="{{ $order->height or $value->type->height }}">
      <div class="input-group-addon"> мм.</div>
    </div>
  </div>

  <div class="col-sm-4">
    <label class="sr-only" for="count">Количество</label>
    <div class="input-group">
      <div class="input-group-addon">Количество</div>
      <input name="count" type="number" min="1" class="calc form-control text-center input-lg" id="count" value="{{ $order->count or '1' }}">
      <div class="input-group-addon"> шт.</div>
    </div>
  </div>

<div id="validFile2Calc" class="col-sm-12" style="display:none">
  <div class="alert alert-danger" style="margin-top:5px">
      <input id="confirm_size" type="checkbox" name="confirm_size">
      <label for="confirm_size"> Я знаю о несовпадении размеров файла-макета и разрешаю изменить макет дизайнером компании под установленые мною размеры.</label>
  </div>
</div>

</div>



@if(count($value->type->product->postpresss) >= 1)

<br>

<script type="text/javascript">
$(function(){


function calc_postpress() {


        price = $("#price").text();

        width = $("#width").val();
        height = $("#height").val();
        count = $("#count").val();

        obrezka = $("#obrezka").val();
        fobrezka = $("#fobrezka").text();

        luvers = $("#luvers").val();
        fluvers = $("#fluvers").text();

        podvorot = $("#podvorot").val();

        discount = $("#discount").text();

        length_sides = 0;
        length_podvorot = 40;
        
        if(obrezka == 1) {
            $("#podvorot").prop( "disabled", true );
            priceobrezka = (((width*2 + height*2)*count)/1000*fobrezka).toFixed(2);
        } else {
            $("#podvorot").prop( "disabled", false );
            priceobrezka = '0.00';
        }


        if (luvers == 2) {
         //По углам
          priceluvers = fluvers*4;
          length_sides = (width*2 + height*2)*count;
        } else if (luvers == 3) {
          //По периметру
          countluvers = (Math.ceil((width*2 + height*2)/300))+2;
          priceluvers = countluvers*count*fluvers;
          length_sides = (width*2 + height*2)*count;
        } else if (luvers == 4) {
          //верх
          countluvers = (Math.ceil((width/300)))+1;
          priceluvers = countluvers*count*fluvers;
          length_sides = (width)*count;
        } else if (luvers == 5) {
          //Верх и низ
          countluvers = (Math.ceil((width/300)))+1;
          priceluvers = countluvers*count*fluvers*2;
          length_sides = (width*2)*count;
        } else if (luvers == 6) {
          //Лево и право
          countluvers = (Math.ceil((height/300)))+1;
          priceluvers = countluvers*count*fluvers*2;
          length_sides = (height*2)*count;
        } else {
          priceluvers = '0.00';
        }
        
        if(podvorot == 7) {

            $("#obrezka").prop( "disabled", true );

            if(length_sides > 1) {
              m2_pricepodvorot = (length_sides*length_podvorot)/1000;
            } else {
              m2_pricepodvorot = (((width*2 + height*2)*count)*length_podvorot/1000);
            }
            pricepodvorot = ((m2_pricepodvorot/1000)*price).toFixed(2);

        } else {
            $("#obrezka").prop( "disabled", false );

            pricepodvorot = '0.00';
        }


        priceobrezka = parseFloat(priceobrezka, 10);
        priceluvers = parseFloat(priceluvers, 10);
        pricepodvorot = parseFloat(pricepodvorot, 10);

        $('#priceobrezka').text(priceobrezka);
        $('#priceluvers').text(priceluvers);
        $('#pricepodvorot').text(pricepodvorot);

        PricePostpress = (priceobrezka+priceluvers+pricepodvorot).toFixed(2);
        $('#PricePostpress').text(PricePostpress);

        //Сумма общая
        area = (width / 1000) * (height / 1000);
        area =  area * count;
        $("#area").text(area.toFixed(2));

        coef_width = $("#coef_width").text();
        coef_height = $("#coef_height").text();
        coef = (coef_width*coef_height)/1000000;
        price = price/coef;
        
        print = area * price;
        $("#print").text(print.toFixed(2));


        PricePostpress = PricePostpress*1;

        sum = print+PricePostpress;
        economy = (sum * discount) / 100;
        $("#economy").text(economy.toFixed(2));
        
        sum = sum - economy;

        $("#sum").text(sum.toFixed(2));
        $("#sumPay").val(sum.toFixed(2));

       

}


// $('.file2_block').hide();
<<<<<<< HEAD

    $("input, select").each(function () {

      $(this).change(function () {
          calc_postpress();
      });
=======
>>>>>>> 83b9a75b56682fc4bed5c133259befdd53198ec7

    $("input, select").each(function () {

      $(this).change(function () {
          calc_postpress();
      });



    });


<<<<<<< HEAD
    });


=======
>>>>>>> 83b9a75b56682fc4bed5c133259befdd53198ec7
calc_postpress();

});

</script>

  <label>Постработы</label>


  <table class="table table-hover">
@foreach($value->type->product->postpresss as $pp)


  <tr>
    <td>{{ $pp->label }}</td>
    <td>{!! Form::select('postpress['.$pp->id.']', $pp->getData(), $getPostpressArr, ['class'=>'form-control', 'id'=>$pp->name]) !!}</td>
    <td>
      @if($pp->f) <span id="f{!! $pp->name !!}">{!! $pp->f !!}</span> грн/м погонный @endif
    </td>
    <td width="128px" class="text-right"><span id="price{!! $pp->name !!}">0</span> грн.</td>
  </tr>
@endforeach

  </table>

@endif

<br>

<label>Комментарий к заказу</label>
<textarea name="comment" class="form-control" rows="3" placeholder="Если необходимо, прокомментируйте детали заказа..."></textarea>

<br>

<table class="table table-striped">
<tr>
	<td>Печать</td>
	<td><span id="print">{{ $value->price }}</span> грн. (<span id="area">{{ round(($value->type->height * $value->type->width)/1000000, 2) }}</span> м2)</td>
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
	<td>Экономия <span id="economy">{{ $value->price * Auth::user()->discount / 100 }}</span> грн.</td>
</tr>
<tr>
	<td>Ваша баланс</td>
	<td><span id="balance">{{ Auth::user()->balance }}</span> грн. (<a href="{!! route('user.transfer') !!}" class="ajax-pay" data-toggle="modal" data-target="#open-modal-pay">Пополнить баланс</a>)</td>
</tr>
<tr>
	<td>Итого к оплате</td>
	<td><b id="sum">{{ $order->sum or $value->price - $value->price * Auth::user()->discount / 100 }}</b> грн.</td>
</tr>
</table>

     <input id="sumPay" type="hidden" name="sum" value="{{ $value->price - $value->price * Auth::user()->discount / 100 }}">

{!! Form::submit('Оформить заказ', ['class' => 'submit btn btn-success btn-lg']) !!}

{!! Form::close() !!}

	</div>
</div>
</div>

@endsection
