<style type="text/css">

</style>

<script type="text/javascript">
$(function(){


$('.file2_block').hide();

    $("input, select").each(function () {

      $(this).change(function () {

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


        if (luvers == 1) {
         //По углам
          priceluvers = fluvers*4;
          length_sides = (width*2 + height*2)*count;
        } else if (luvers == 2) {
          //По периметру
          countluvers = (Math.ceil((width*2 + height*2)/300))+2;
          priceluvers = countluvers*count*fluvers;
          length_sides = (width*2 + height*2)*count;
        } else if (luvers == 3) {
          //верх
          countluvers = (Math.ceil((width/300)))+1;
          priceluvers = countluvers*count*fluvers;
          length_sides = (width)*count;
        } else if (luvers == 4) {
          //Верх и низ
          countluvers = (Math.ceil((width/300)))+1;
          priceluvers = countluvers*count*fluvers*2;
          length_sides = (width*2)*count;
        } else if (luvers == 5) {
          //Лево и право
          countluvers = (Math.ceil((height/300)))+1;
          priceluvers = countluvers*count*fluvers*2;
          length_sides = (height*2)*count;
        } else {
          priceluvers = '0.00';
        }
        
        if(podvorot == 1) {

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

        print = area * price;
        $("#print").text(print.toFixed(2));

        economy = (print * discount) / 100;
        $("#economy").text(economy.toFixed(2));
        
        sum = ((print-economy)+PricePostpress*1);
        $("#sum").text(sum.toFixed(2));
        $("#sumPay").val(sum.toFixed(2));

        /*
        resdata = {};
        resdata.print = {};
        resdata.print.area = area.toFixed(2);
        resdata.print.sum = print.toFixed(2);

        resdata.economy = economy.toFixed(2);
        resdata.discount = discount;

        resdata.postpress = {};
        resdata.postpress.obrezka = priceobrezka;
        resdata.postpress.luvers = priceluvers;
        resdata.postpress.podvorot = pricepodvorot;
        resdata.postpress.sum = PricePostpress;

        resdata.sum = sum.toFixed(2);

        data = JSON.stringify(resdata);

        $('#data').val(data);
        */

       });



    });




});

</script>

<label>Постработы</label>

<table class="table table-hover">
  @foreach($postpress as $pp)
    <tr>
      <td>{!! $pp->label !!}</td>
      
        @if($pp->name == 'obrezka')
        <td>
          {!! Form::select($pp->name, $postpress_data[$pp->name], '0', ['class'=>'form-control', 'id'=>$pp->name]) !!}
          
       </td>
       <td><span style="display:none" id="price{!! $pp->name !!}">0</span><span id="f{!! $pp->name !!}">{!! $pp->f !!}</span> грн/м погонный</td>
        @endif

        @if($pp->name == 'luvers')
        <td>
        {!! Form::select($pp->name, $postpress_data[$pp->name], '0', ['class'=>'form-control', 'id'=>$pp->name]) !!}
        </td>
        <td><span style="display:none" id="price{!! $pp->name !!}">0</span><span id="f{!! $pp->name !!}">{!! $pp->f !!}</span> грн/шт.</td>
        
        @endif

        @if($pp->name == 'podvorot')
        <td>
        {!! Form::select($pp->name, $postpress_data[$pp->name], '0', ['class'=>'form-control', 'id'=>$pp->name]) !!}
        </td>
        <td><span style="display:none" id="price{!! $pp->name !!}">0</span>4 см на сторону</td>
        @endif
      
    </tr>
  @endforeach
</table>


