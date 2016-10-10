
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







//START calc order and postpress
    $('.calc').change(function(e) {
        e.preventDefault();
        CalcPrint();
    });

function CalcPrint() {

        price = $("#price").text();
        discount = $("#discount").text();
        postpress = $("#PricePostpress").text();

        width = $("#width").val();
        height = $("#height").val();
        count = $("#count").val();
        
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







})(jQuery);


new WOW().init();