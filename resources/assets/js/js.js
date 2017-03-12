
(function ($) {


$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});


           $('.body h1').addClass('wow fadeInLeft animated').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "200" );
            $('.top-container .top-contacts-circle').addClass('wow fadeInDown animated').attr( "data-wow-duration", "0.5s" );
            $('.top-container .top-contacts-circle-text').addClass('wow fadeInDown animated').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-delay", "0.25s" );

            $('.page p').addClass('wow fadeInUp animated').attr( "data-wow-duration", "0.25s" ).attr( "data-wow-offset", "100" ).attr( "data-wow-delay", "0.25s" );

            $('.catalog-block').addClass('wow fadeInUp animated');
            $('.catalog-block').attr( "data-wow-duration", "0.2s" );
            $('.catalog-block').attr( "data-wow-offset", "100" );
            $('.catalog-block').attr( "data-wow-delay", "0.5s" );

           $('.catalog .thumbnail').addClass('wow zoomIn animated').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "100" ).attr( "data-wow-delay", "0.25s" );
           $('.catalog .menu ul, .catalog .menu h3').addClass('wow fadeInLeft animated').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "30" ).attr( "data-wow-delay", "0.5s" );

           $('.post .row').addClass('wow fadeInLeft animated');
           $('.post .row').attr("data-wow-duration", "0.5s" ).attr( "data-wow-offset", "25" ).attr( "data-wow-delay", "0.25s");

           $('.gal-container h2').addClass('wow fadeInLeft animated');
           $('.gal-container h2').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "25" ).attr( "data-wow-delay", "0.25s" );

           $('.gal-item').addClass('wow zoomIn animated');
           $('.gal-item').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "50" ).attr( "data-wow-delay", "0.5s" );

            $('.footer').addClass('wow fadeInUp animated').attr( "data-wow-duration", "0.2s" ).attr( "data-wow-offset", "100" ).attr( "data-wow-delay", "0.25s" );


    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
        $('#back-to-top').tooltip('hide');
    });

    $('#back-to-top').tooltip('show');

    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });


    $('[data-toggle="tooltip"]').tooltip();




    $(".ajax-pay").click(function( event ) {


                $('.ajaxloader').show();

        event.preventDefault();

        $.ajax({
            url: this.href,
            success: function(data) {
                $('.modal-dialog-pay').html(data);
                $('.ajaxloader').hide();
            }
        });

    });

$('.send2server').click(function( event ) {

    event.preventDefault();

    var $this = $(this);
    $this.button('loading');

          $.ajax({
            url: this.href,
            error: function(data) {
                $this.button('reset');
                $('.alert-dismissible').addClass('alert-danger');
                $('.alert-dismissible').show();
                $('.alert-dismissible .responseText').html(data.responseText);
           },
            success: function(data) {
                $this.button('reset');
                $this.hide();
                $('.alert-dismissible').addClass('alert-success');
                $('.alert-dismissible').show();
                $('.alert-dismissible .responseText').html('Отправлено успешно');
           }
        });


});



    $(".ajax").click(function( event ) {

        event.preventDefault();

        $.ajax({
            url: this.href,
            success: function(data) {
                $('.modal-dialog').html(data);
            }
        });

    });

      $( ".modal-dialog" ).submit(function(e) {

        e.preventDefault();

        var form = $('.modal-dialog form');
        var formURL = $(form).attr("action");
        var formmethod = $(form).attr("method");
        var sendData = $(form).serialize();

        $.ajax({
            type: formmethod,
            url: formURL,
            data: sendData,
            success: function (data, textStatus, errorThrown) {
                $('.modal-dialog').html(data);
            }
        });

        return false;
    });



function make_message(id, name, cssclass, message) {
        $("#make_message #"+id).remove();
        $("#make_message").append('<div style="margin-top:20px;" id="'+id+'" class="'+cssclass+'"><input required="required" id="'+name+'" type="checkbox" name="'+name+'"> <label for="'+name+'">'+message+'</label></div>');
}



function remove_message(id) {
    $("#make_message #"+id).remove();
}

//Проверка на ширину материала, types:roll_width
function validcut(width, height) {

    roll_width = $('#roll_width').text();
    roll_width = parseFloat(roll_width, 10);
    width = parseFloat(width, 10);
    height = parseFloat(height, 10);

    if(roll_width > 10) {

        this.make_message = make_message(
                        'vcrw',
                        'validcut_roll_width',
                        'alert alert-danger',
                        'Подтвердите что ваш заказ будет состоять из 2-х частей. Размер материала '+roll_width+'мм, '
                        );

            switch( true ){

              case roll_width < width:
                this.make_message;
              break;

              case roll_width < height:
                this.make_message;
              break;

              case roll_width < height && roll_width < width:
                this.make_message;
              break;

              case roll_width > height && roll_width > width:
                remove_message('vcrw');

            };
     }
   
}

function postpresss_select_disabled() {

//Включение/выключение select 
    $( ".postpresss select option:selected").each(function() {

        item = $(this).parent();
        

        if(item.prop("disabled") != true) {

            switch(item.attr('id')){

               case 'obrezka':
                   if(item.val() >= 1) {
                        $("#karman, #podvorot").prop("disabled", true);
                    } else {
                        $("#karman, #podvorot").prop("disabled", false);
                    }
               break;

               case 'podvorot':
                   if(item.val() >= 1) {
                        $("#karman").prop("disabled", true);
                    } else {
                        $("#karman").prop("disabled", false);
                    }
               break;
               
               case 'karman':
                   if(item.val() >= 1) {
                        $("#obrezka, #podvorot").prop("disabled", true);
                    } else {
                        $("#obrezka, #podvorot").prop("disabled", false);
                    }
               break;

              
            };
        }
    });

}


function postpresss_select_each() {
     $('.postpresss select').each(function() {
        if($(this).next('#ppp').find("div").length >= 1) { calc_ppp($(this).attr('id'), $(this).attr('name'), $(this).val()); }
      });

    postpresss_select_disabled();

}


function calc_postpress() {

        price = $("#price").text();

        width = $("#width").val();
        height = $("#height").val();
        count = $("#count").val();

        obrezka = $("#obrezka").val();
        fobrezka = $("#fobrezka").text();

        luvers = $("#luvers").val();
        fluvers = $("#fluvers").text();

        karman = $("#karman").val();

        podvorot = $("#podvorot").val();

        discount = $("#discount").text();


        length_sides = 0;
        length_podvorot = 40;
        

        //Карман
        length_karman = 150;

        switch(karman){

            //Нет
           case '0':
            pricekarman = '0.00';
           break;     

           //Только сверху
           case '12':
            m2_karman = (((width*length_karman)*count)/1000);
            pricekarman = ((m2_karman/1000)*price).toFixed(2);
           break;
           
           //Сверху и снизу
           case '13':
            m2_karman = ((((width*length_karman)*2)*count)/1000);
            pricekarman = ((m2_karman/1000)*price).toFixed(2);
           break;
           
           //По бокам
           case '14':
            m2_karman = ((((height*length_karman)*2)*count)/1000);
            pricekarman = ((m2_karman/1000)*price).toFixed(2);
           break;

           default:
            pricekarman = '0.00';
           break;

        };


        //Обрезка
        if(obrezka == 1) {
            //$("#karman").prop( "disabled", true );
            //$("#podvorot").prop( "disabled", true );
            priceobrezka = (((width*2 + height*2)*count)/1000*fobrezka).toFixed(2);
        } else {
            //$("#karman").prop( "disabled", false );
            //$("#podvorot").prop( "disabled", false );
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

        //Подворот
        if(podvorot == 7) {

            //$("#obrezka").prop( "disabled", true );

            if(length_sides > 1) {
              m2_pricepodvorot = (length_sides*length_podvorot)/1000;
            } else {
              m2_pricepodvorot = (((width*2 + height*2)*count)*length_podvorot/1000);
            }
            pricepodvorot = ((m2_pricepodvorot/1000)*price).toFixed(2);

        } else {
            //$("#obrezka").prop( "disabled", false );
            pricepodvorot = '0.00';
        }



        priceobrezka = parseFloat(priceobrezka, 10);
        priceluvers = parseFloat(priceluvers, 10);
        pricepodvorot = parseFloat(pricepodvorot, 10);
        pricekarman = parseFloat(pricekarman, 10);

        $('#priceobrezka').text(priceobrezka);
        $('#priceluvers').text(priceluvers);
        $('#pricepodvorot').text(pricepodvorot);
        $('#pricekarman').text(pricekarman);

        PricePostpress = (priceobrezka+priceluvers+pricepodvorot+pricekarman).toFixed(2);
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

    
        postpresss_select_each();

}


function calc_ppp(name, postpress_id, val) {
          ppprice = $("div[pppid='"+val+"']").attr('ppprice');
          ppprice_count = $("div[pppid='"+val+"']").attr('ppprice_count');

            area = $("#area").text();
            pppsum = ((ppprice/ppprice_count)*area).toFixed(2);

            if(pppsum == 'NaN') {
              pppsum = '0.00';
            }

            PricePostpress = $('#PricePostpress').text();
            

            pppsum = parseFloat(pppsum, 10);
            PricePostpress = PricePostpress*1;
            
            allpppsum = (pppsum+PricePostpress).toFixed(2);


            $("#price"+name+"").text(pppsum);
            $('#PricePostpress').text(allpppsum);

}


$("input, select").each(function () {
  $(this).change(function () { calc_postpress(); });
});

calc_postpress();






// --------------- Start Upload Files function --------------- 

function uploaderFileUploaded(up, file, response) {
                        
        res = JSON.parse(response.response);

        $( "#file0" ).val( res.result.fname );

        delete res.result.fname;
        
        console0data = '<div class="console0 alert alert-success" role="alert"><div id="res"></div></div>';

        $(".file0_block #console0").html(console0data);

            $.each( res.result, function( key, value ) {

                if(value.valid == true) {
                    var status_class = 'glyphicon-ok success';
                }
                if(value.valid == false) {
                    var status_class = 'glyphicon-remove';
                    $( ".file0_block #console0 .alert" ).removeClass("alert-success").addClass("alert-danger");
                }

                $(".file0_block #console0 #res").append( '<div><span class="glyphicon '+status_class+'" style="margin-right:5px"></span> '+value.title+'</div>' );
            });

         if(res.result.width.valid == true && res.result.height.valid == true) {

            $( "#width" ).val(res.result.width.data);
            $( "#height" ).val(res.result.height.data);
        
            $( "#width_file0" ).val(res.result.width.data);
            $( "#height_file0" ).val(res.result.height.data);
        }


        CalcPrint();
        
}

var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
     
    browse_button : 'pickfiles0',
    container: document.getElementById('container0'), 
     
        url : '/printfile/upload',
    
        chunk_size: '1mb',

         headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
     
    filters : {

        max_file_size : '2048000kb',
        mime_types: [
            {title : "Tiff files", extensions : "tif,tiff"},
        ]
    },

    flash_swf_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.swf',
    silverlight_xap_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.xap',
     
    multi_selection: false,
 
    init: {
        PostInit: function() {
        },
 
        FilesAdded: function(up, files) {
            $('#container0 .thumbnail').remove();
            res_data = '<div id="' + files[0].id + '">' + files[0].name + ' - ' + plupload.formatSize(files[0].size) + ' - <b></b></div>';
            $('#filelist0').html(res_data);
            up.start();
        },
 
        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            document.getElementById('console0').innerHTML = '';
        },
    

        FileUploaded: function(up, file, response) {

        uploaderFileUploaded(up, file, response);

        },

        Error: function(up, err) {

            document.getElementById('console0').innerHTML = '<div class="console0 alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ err.message +'</div>';
        }
    }
});



function uploaderFileUploaded1(up, file, response) {
                        
        res = JSON.parse(response.response);

        $( "#file1" ).val( res.result.fname );

        delete res.result.fname;
        
        console1data = '<div class="console1 alert alert-success" role="alert"><div id="res"></div></div>';

        $(".file1_block #console1").html(console1data);

            $.each( res.result, function( key, value ) {

                if(value.valid == true) {
                    var status_class = 'glyphicon-ok success';
                }
                if(value.valid == false) {
                    var status_class = 'glyphicon-remove';
                    $( ".file1_block #console1 .alert" ).removeClass("alert-success").addClass("alert-danger");
                }

                $(".file1_block #console1 #res").append( '<div><span class="glyphicon '+status_class+'" style="margin-right:5px"></span> '+value.title+'</div>' );
            });

         if(res.result.width.valid == true && res.result.height.valid == true) {

            $( "#width" ).val(res.result.width.data);
            $( "#height" ).val(res.result.height.data);
        
            $( "#width_file1" ).val(res.result.width.data);
            $( "#height_file1" ).val(res.result.height.data);
        }

        CalcPrint();
        
}

var uploader1 = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
     
    browse_button : 'pickfiles1',
    container: document.getElementById('container1'), 
     
        url : '/printfile/upload',
    
        chunk_size: '1mb',

         headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
     
    filters : {

        max_file_size : '2048000kb',
        mime_types: [
            {title : "Tiff files", extensions : "tif,tiff"},
        ]
    },

    flash_swf_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.swf',
    silverlight_xap_url : '/vendor/jildertmiedema/laravel-plupload/js/Moxie.xap',
     
    multi_selection: false,
 
    init: {
        PostInit: function() {
        },
 
        FilesAdded: function(up, files) {
            $('#container1 .thumbnail').remove();
            res_data = '<div id="' + files[0].id + '">' + files[0].name + ' - ' + plupload.formatSize(files[0].size) + ' - <b></b></div>';
            $('#filelist1').html(res_data);
            up.start();
        },
 
        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            document.getElementById('console1').innerHTML = '';
        },
    

        FileUploaded: function(up, file, response) {

        uploaderFileUploaded1(up, file, response);

        },

        Error: function(up, err) {

            document.getElementById('console1').innerHTML = '<div class="console1 alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ err.message +'</div>';
        }
    }
});


// --------------- End Upload Files function --------------- 

//START calc order and postpress
    $('.calc').change(function(e) {
        e.preventDefault();
        CalcPrint();
    });

function validFile2Calc(width, height) {

    width_file0 = $('#width_file0').val();
    height_file0 = $('#height_file0').val();

    if(width_file0 > 10 && height_file0 > 10) {

        if(width_file0 == width && height_file0 == height) {
                
                remove_message('confirm_size');

                $('#height').css('color', '#3c763d');
                $('#width').css('color', '#3c763d');

        } else {

                make_message(
                    'confirm_size',
                    'confirm_size_name',
                    'alert alert-danger',
                    'Я знаю о несовпадении размеров файла-макета и разрешаю изменить макет дизайнером компании под установленые мною размеры.'
                    );


            if(width_file0 != width) {
                $('#width').css('color', '#a94442');
            } else {
                $('#width').css('color', '#3c763d');
            }

            if(height_file0 != height) {
                $('#height').css('color', '#a94442');
            } else {
                $('#height').css('color', '#3c763d');
            }
        }
    }


    validcut(width, height);
}


function CalcPrint() {

        calc_postpress();

        price = $("#price").text();
        discount = $("#discount").text();
        postpress = $("#PricePostpress").text();

        width = $("#width").val();
        height = $("#height").val();
        count = $("#count").val();

        validFile2Calc(width, height);
        
        coef_width = $("#coef_width").text();
        coef_height = $("#coef_height").text();
        coef = (coef_width*coef_height)/1000000;

        area = (width / 1000) * (height / 1000);
        area =  area * count;
        $("#area").text(area.toFixed(2));

        price = price/coef;
        print = area * price;
        $("#print").text(print.toFixed(2));

        economy = (print * discount) / 100;
        $("#economy").text(economy.toFixed(2));
        
        sum = ((print-economy)+postpress*1);
        $("#sum").text(sum.toFixed(2));
        $("#sumPay").val(sum.toFixed(2));
}
//END calc order and postpress


    uploader.init();
    uploader1.init();

var cities = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('DescriptionRu'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  //prefetch: 'novaposhta',
  remote: {
    url: 'novaposhta/getcity/%QUERY',
    wildcard: '%QUERY'
  }
});

$('#city .typeahead').typeahead(null, {
  name: 'getcity',
  display: 'DescriptionRu',
  source: cities
});

$('.typeahead').bind('typeahead:select', function(ev, result) 
    {
        $('select[name="warehouses"]').html('<option>Поиск отделений...</option>');

               $.ajax({
                    type: "GET",
                    url: 'novaposhta/city/'+result.Ref,
                    success: function(data) {

                            

                            $('select[name="warehouses"]').html('');

                            $('select[name="warehouses"]').append($.map(data, function(o) {
                              return $('<option/>', {
                                value: o.DescriptionRu,
                                text: o.DescriptionRu
                              });
                            }));

                            $('select[name="warehouses"]').removeAttr( "disabled" );

                    }
            });

    });


})(jQuery);

