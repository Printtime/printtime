
(function ($) {


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
            // $('.catalog .gal-item').addClass('wow fadeInUp animated');
            // $('.catalog .gal-item').attr( "data-wow-duration", "0.2s" );
            // $('.catalog .gal-item').attr( "data-wow-offset", "150" );
            // $('.catalog .gal-item').attr( "data-wow-delay", "0.25s" );           


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





    $(".ajax").click(function( event ) {

        event.preventDefault();

        $.ajax({
            url: this.href,
            success: function(data) {
                $('.modal-dialog').html(data);
            }
        });


    });

           //  $('.front .view-catalog .views-row-odd').addClass('wow fadeInRight animated');
           //  $('.front .view-catalog .views-row-odd').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "200" );

           //  $('.front .view-catalog .views-row-even').addClass('wow fadeInLeft animated');
           //  $('.front .view-catalog .views-row-even').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "200" );

           //  $('.node-teaser .group-header').addClass('wow fadeInLeft animated');
           //  $('.node-teaser .group-header').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "200" );

           //  $('.node-teaser .group-left').addClass('wow fadeInLeft animated');
           //  $('.node-teaser .group-left').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "200" ).attr( "data-wow-offset", "200" ).attr( "data-wow-delay", "0.25s" );

           //  $('.node-teaser .group-middle').addClass('wow fadeInUp animated');
           //  $('.node-teaser .group-middle').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "200" ).attr( "data-wow-offset", "200" ).attr( "data-wow-delay", "0.5s" );

           //  $('.node-teaser .group-right').addClass('wow fadeInRight animated');
           //  $('.node-teaser .group-right').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "200" ).attr( "data-wow-offset", "200" ).attr( "data-wow-delay", "0.75s" );


           //  $('.front .view-catalog .field-name-field-image').addClass('wow zoomIn animated');
           //  $('.front .view-catalog .field-name-field-image').attr( "data-wow-duration", "0.5s" ).attr( "data-wow-offset", "100" ).attr( "data-wow-delay", "0.5s" );

           //  $('.page-header').addClass('wow fadeInRight animated');
           //  $('.page-header').attr( "data-wow-duration", "0.5s" );

           //  $('.page-taxonomy .field-name-field-slide').addClass('wow flipInX animated');
           // // $('.page-node .field-name-field-slide').attr( "data-wow-delay", "0.5s" );
           //  $('.page-taxonomy .field-name-field-slide').attr( "data-wow-duration", "1s" );


})(jQuery);


new WOW().init();