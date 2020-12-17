$(function () {

    "use stric";
    // Scroll Top

    var scrollButton = $("#scroll-top");

    $(window).scroll(function () {

        if ($(this).scrollTop() >= 150) {
            scrollButton.show();
        } else {
            scrollButton.hide();
        }

    });


    // scroll top

    scrollButton.click(function () {

        $("html,body").animate({
            scrollTop: 0
        }, 1500);
    });

    // loading

    $(window).on('load', function () {
        if ($('#preload').length) {
            $('#preload').delay(200).fadeOut(500);
        }
    });

    // sldier
    $("#layerslider").layerSlider({
        type: 'responsive',
        skin: 'outline',
        pauseOnHover: 'disabled',
        fitScreenWidth: true,
        navStartStop: false,
        allowFullscreen: false,
        skinsPath: './images/img/skins/',
        thumbnailNavigation: false
    });

    // show collaps navbar

    var theLanguage = $('body').css('direction');

    $('#nav-icon4').click(function () {
        $(this).toggleClass('navIconToggle');
        if (theLanguage == 'rtl') {
            if ($(this).hasClass('navIconToggle')) {
                $('.navbar-default .navbar-collapse').animate({
                    right: 0
                }, 500);
            } else {
                $('.navbar-default .navbar-collapse').animate({
                    right: "-500px"
                }, 500);
            }
        } else {
            if ($(this).hasClass('navIconToggle')) {
                $('.navbar-default .navbar-collapse').animate({
                    left: 0
                }, 500);
            } else {
                $('.navbar-default .navbar-collapse').animate({
                    left: "-500px"
                }, 500);
            }
        }
    });

    // Optimalisation: Store the references outside the event handler:
    var $window = $(window);

    function checkWidth(e) {
        var windowsize = $window.width();
        if (windowsize > 767) {
            $('ul.nav li.dropdown-m,.multy .dropdown-item.dropdown').hover(function () {
                $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
            }, function () {
                $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();
            });
            $('.navbar .dropdown-m > a').click(function () {
                location.href = this.href;
            });
            document.addEventListener("touchstart", function () {}, true);
        }
    }
    // Execute on load
    checkWidth();
    // Bind event listener
    $(window).resize(checkWidth);

    $('.navbar .dropdown-item').on('click', function (e) {
        var $el = $(this).children('.dropdown-toggle');
        var $parent = $el.offsetParent(".dropdown-menu");
        $(this).parent("li").toggleClass('open');

        if (!$parent.parent().hasClass('navbar-nav')) {
            if ($parent.hasClass('show')) {
                $parent.removeClass('show');
                $el.next().removeClass('show');
                $el.next().css({
                    "top": -999,
                    "left": -999
                });
            } else {
                $parent.parent().find('.show').removeClass('show');
                $parent.addClass('show');
                $el.next().addClass('show');
                $el.next().css({
                    "top": $el[0].offsetTop,
                    "left": $parent.outerWidth() - 4
                });
            }
            e.preventDefault();
            e.stopPropagation();
        }
    });

    $('.navbar .dropdown').on('hidden.bs.dropdown', function () {
        $(this).find('li.dropdown').removeClass('show open');
        $(this).find('ul.dropdown-menu').removeClass('show open');
    });

});
