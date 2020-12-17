/**
 * Created by shaimaa on 9/25/2017.
 */
$(document).ready(function() {

    /*Slider*/
    $("#owl-demo").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        items:1,
        loop:true,
        nav:true,
        dots:false,
        autoplay:true,
        autoplayTimeout:10000,
        navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"]
    });

    /*Counter*/
    // var a = 0;
    // $(window).scroll(function() {
    //     var oTop = $('.count_data').offset().top - window.innerHeight;
    //     if (a == 0 && $(window).scrollTop() > oTop) {
    //         $('.counter').each(function() {
    //             var $this = $(this),
    //                 countTo = $this.attr('data-count');
    //             $({ countNum: $this.text()}).animate({
    //                     countNum: countTo
    //                 },
    //                 {
    //                     duration: 10000,
    //                     easing:'linear',
    //                     step: function() {
    //                         $this.text(Math.floor(this.countNum));
    //                     },
    //                     complete: function() {
    //                         $this.text(this.countNum);
    //                         //alert('finished');
    //                     }
    //                 });
    //         });
    //         a = 1;
    //     }
    // });

    /*Calender*/
    $( "#datepicker" ).datepicker({
        dayNamesMin: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
        monthNames: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
    });

});
