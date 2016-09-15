<style type="text/css">

</style>

<script type="text/javascript">
$(function(){

function calcPostpress(e) {

    e.preventDefault();
    $this = $(this);

    var width = $("#width").val();
    var height = $("#height").val();
    var count = $("#count").val();

    var val = $this.val();
    var name = $this.attr('name');
    var price = $this.parent().next().find('#price');
    var f = $this.parent().next().find('#f').text();

    if(name == 'obrezka' && val == '1') {
      price.text(((width*2+height*2)*2)/1000*f);
    } else {
      price.text(0);
    }

}

$( "select" ).on( "change", calcPostpress );
$( ".calc" ).on( "change", calcPostpress );

// $("select :selected").html();

//     $('select option:selected').change(function(e) {
//         e.preventDefault();
//         // var str = this.text();
//         // var val = $(this).val();
//         console.log(this.text());
//         console.log(this.val());
//     });

});

</script>

<label>Постработы</label>

<table class="table table-hover">
  @foreach($postpress as $pp)
    <tr>
      <td>{!! $pp->label !!}</td>
      
        @if($pp->id == 1)
        <td>
          {!! Form::select($pp->name, array('0' => 'Без обрезки', '1' => 'Обрезать в размер'), '0', ['class'=>'form-control']) !!}
          
       </td>
       <td><span id="price">0</span><span id="f">{!! $pp->f !!}</span> грн/м погонный</td>
        @endif

        @if($pp->id == 2)
        <td>
        {!! Form::select($pp->name, [
          '0' => 'Нет',
          '1' => 'По углам',
          '2' => 'По периметру',
          '3' => 'Верх',
          '4' => 'Верх и низ',
          '5' => 'Лево и право',
        ], '0', ['class'=>'form-control']) !!}
        </td>
        <td><span id="price">0</span><span id="f">{!! $pp->f !!}</span> грн/шт.</td>
        
        @endif

        @if($pp->id == 3)
        <td>
        {!! Form::select($pp->name, [
          '0' => 'Нет',
          '1' => 'Есть',
        ], '0', ['class'=>'form-control']) !!}
        </td>
        <td><span id="price">0</span>+4 см с каждой стороны</td>
        @endif

        @if($pp->id == 4)
        <td>
        {!! Form::select($pp->name, [
          '0' => 'Нет',
          '1' => 'Только сверху',
          '2' => 'Только снизу',
          '3' => 'Только слева',
          '4' => 'Только справа',
          '5' => 'Сверху и снизу',
          '5' => 'Слева и справа',
          '5' => 'По периметру',
        ], '0', ['class'=>'form-control']) !!}
        </td>
        <td><span id="price">0</span><span id="f">{!! $pp->f !!}</span> грн/м погонный</td>
        @endif

        @if($pp->id == 5)
        <td>
        {!! Form::select($pp->name, [
          '0' => 'Нет',
          '1' => 'По вертикали',
          '2' => 'По горизонтали',
        ], '0', ['class'=>'form-control']) !!}
        </td>
        <td><span id="price">0</span><span id="f">{!! $pp->f !!}</span> грн/м погонный</td>
        @endif
      
    </tr>
  @endforeach
  <tr>
    <td>Стоимость постработ</td>
    <td><span id="PricePostpress">0</span> грн.</td>
    <td></td>
  </tr>
</table>


