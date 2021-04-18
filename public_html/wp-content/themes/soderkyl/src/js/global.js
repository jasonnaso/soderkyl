$ = jQuery;

var loader = {

    show: function(callback)
    {
        $('.preloader').fadeIn(function()
        {
            if ('function' === typeof callback)
            {
                callback();
            }
        });
    },

    hide: function(callback)
    {
        $('.preloader').fadeOut(function()
        {
            if ('function' === typeof callback)
            {
                callback();
            }
        });
    }
};

window.onload = function()
{
    $().nEqualHeight();

    bsCustomFileInput.init();

    $('body').on('click', '.single-product .product a img', function(event) {

        event.preventDefault();

        var src = $(this).attr('src');
        var srcset = $(this).attr('srcset');

        $('.modal-body').html($('<img>', {src: src, srcset: srcset}));

        $('#thumbnail-modal').modal('show');
    });


    // Hero scroll to form button
    /*
    $('.scroll-to-form').on('click', function(event)
    {
        event.preventDefault();

        $('html, body').animate({

            scrollTop: $('#soderkyl-form').offset().top - 70

        }, 1500);
    });
    */

    // Hero book inventory button
    $(document).on('click', '.book-inventory', function(event) {
        event.preventDefault();
        $('#form-inventory-modal').modal('show');
    });

    // Hero book service button
    $(document).on('click', '.book-service', function(event) {
        event.preventDefault();
        $('#form-service-modal').modal('show');
    });

    $(document).on('click', '.book-appliances', function(event) {
        event.preventDefault();
        $('#form-appliances-modal').modal('show');
    });

    $(document).on('click', '.book-gas-stove', function(event) {
        event.preventDefault();
        $('#form-gas-stove-modal').modal('show');
    });

    $(document).on('click', '.book-commercial-cool', function(event) {
        event.preventDefault();
        $('#form-commercial-cool-modal').modal('show');
    });

    $(document).on('click', '.btn-product-info', function(event) {
        event.preventDefault();
        $('#form-product-modal').modal('show');
    });

    // Footer chevron scroll mobile
    $('#footer-chevron-scroll-mobile').click(function(event) {
        $('html, body').animate({ scrollTop: 0 }, 600);
        return false;
    });

    // Footer chevron scroll
    $('#footer-chevron-scroll').click(function(event) {
        $('html, body').animate({ scrollTop: 0 }, 600);
        return false;
    });

    // About us counter

    var hasStarted = false;

    function checkScroll() {

        if ($('#aboutUsScroll').length)
        {
            if ($(window).scrollTop() > ($('#aboutUsScroll').offset().top - $('#aboutUsScroll').height()))
            {
                if (!hasStarted)
                {
                    $('.counter').each(function() {

                        var $this = $(this),

                            countTo = $this.attr('data-count');

                        $({ countNum: $this.text()}).animate({

                            countNum: countTo
                        },

                        {
                            duration: 2000,
                            easing:'linear',

                            step: function()
                            {
                                $this.text(Math.floor(this.countNum));
                            },

                                complete: function()
                                {
                                    $this.text(this.countNum);
                                }
                        });
                    });

                    hasStarted = true;
                }
            }
        }
    }

    $(window).scroll(checkScroll);

    checkScroll();
};

// Add slideDown animation to dropdown

    $('.dropdown').on('show.bs.dropdown', function(e)
    {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200);
    });


    $('.dropdown').on('hide.bs.dropdown', function(e)
    {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
    });



    // window.onscroll = function() {scrollFunction()};

    // function scrollFunction()
    // {console.log("Time");

    //     if (document.body.scrollTop > 90 || document.documentElement.scrollTop > 90)
    //     {

    //         $(".soderkyl-header-logo").css("max-height", "40px" );

    //     }
    //     else
    //     {
    //         $(".soderkyl-header-logo").css("max-height", "75px" );
    //     }
    // }

    var hasShrunk = false;

    if ($(window).width() > 768) {

        window.onscroll = function() {scrollFunction()};

        function scrollFunction()
        {

            if (document.body.scrollTop > 90 || document.documentElement.scrollTop > 90)
            {


                $(".soderkyl-header-logo").css({"max-height" : "40px", "transition": "max-height 0.3s ease-in-out" }, {queue: false });
            }
            else
            {
                $(".soderkyl-header-logo").css({"max-height" : "75px", "transition": "max-height 0.3s ease-in-out"  }, {queue: false });
            }
        }
    }