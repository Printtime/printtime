
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

        event.preventDefault();

        $.ajax({
            url: this.href,
            success: function(data) {
                $('.modal-dialog-pay').html(data);
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




function uploaderFileUploaded(up, file, response) {
                        
        res = JSON.parse(response.response);

        $( "#file1" ).val( res.result.fname );

        delete res.result.fname;
        
        consoledata = '<div class="console alert alert-success" role="alert"><div id="res"></div></div>';

        $("#console").html(consoledata);

            $.each( res.result, function( key, value ) {

                if(value.valid == true) {
                    var status_class = 'glyphicon-ok success';
                }
                if(value.valid == false) {
                    var status_class = 'glyphicon-remove';
                    $( "#console .alert" ).removeClass("alert-success").addClass("alert-danger");
                }

                $("#console #res").append( '<div><span class="glyphicon '+status_class+'" style="margin-right:5px"></span> '+value.title+'</div>' );
            });

         if(res.result.width.valid == true && res.result.height.valid == true) {

            $( "#width" ).val(res.result.width.data);
            $( "#height" ).val(res.result.height.data);
        
            $( "#width_file1" ).val(res.result.width.data);
            $( "#height_file1" ).val(res.result.height.data);
        }

        CalcPrint();
        
}







var uploader = new plupload.Uploader({
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
            //{title : "Image files", extensions : "jpg,gif,png"}
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
            document.getElementById('console').innerHTML = '';
        },
    

        FileUploaded: function(up, file, response) {

        uploaderFileUploaded(up, file, response);

        },

        Error: function(up, err) {

            document.getElementById('console').innerHTML = '<div class="console alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+ err.message +'</div>';
        }
    }
});

















//START calc order and postpress
    $('.calc').change(function(e) {
        e.preventDefault();
        CalcPrint();
    });

function validFile2Calc(width, height) {

    width_file1 = $('#width_file1').val();
    height_file1 = $('#height_file1').val();

    if(width_file1 > 10 && height_file1 > 10) {

        if(width_file1 == width && height_file1 == height) {
                
                $('#validFile2Calc').css('display', 'none');

                $('#height').css('color', '#3c763d');
                $('#width').css('color', '#3c763d');

                $('#confirm_size').removeAttr("required");

        } else {

            $('#confirm_size').attr("required", "required");

            $('#validFile2Calc').css('display', '');

            if(width_file1 != width) {
                $('#width').css('color', '#a94442');
            } else {
                $('#width').css('color', '#3c763d');
            }

            if(height_file1 != height) {
                $('#height').css('color', '#a94442');
            } else {
                $('#height').css('color', '#3c763d');
            }
        }
    }

}

function CalcPrint() {

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
        // console.log(coef_height);

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



})(jQuery);


//new WOW().init();

