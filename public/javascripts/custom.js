
  $(document).ready(function($) {

    if($( ".middle_part div.body div.part div" ).html()==''){
      $( ".middle_part div.body" ).removeClass( "body" );
    }
      /*----------------------------------------------------------*/
      /*PRETTYPHOTO  JS */
      /*----------------------------------------------------------*/
      //$("a[data-rel^='prettyPhoto']").prettyPhoto({overlay_gallery: false});
      $("a[data-rel^='prettyPhoto']").prettyPhoto({hook: 'data-rel'});

        /*----------------------------------------------------------*/
        /*TABS JS */
        /*----------------------------------------------------------*/
        (function() {
          var $tabsNav    = $('.tabs-nav'),
          $tabsNavLis = $tabsNav.children('li'),
          $tabContent = $('.tab-content');
          $tabContent.hide();
          $tabsNavLis.first().addClass('active').show();
          $tabContent.first().show();
          $tabsNavLis.on('click', function(e) {
            var $this = $(this);
            $tabsNavLis.removeClass('active');
            $this.addClass('active');
            $tabContent.hide();
            $( $this.find('a').attr('href') ).fadeIn(700);
            e.preventDefault();
          });
        })();
        /*----------------------------------------------------------*/
        /*ACCORDION  JS */
        /*----------------------------------------------------------*/
        initAccordion();
        function initAccordion() {
          jQuery('.accordion-item').each(function(i) {
            var item=jQuery(this);
            item.find('.accordion-content').slideUp(0);
            item.find('.accordion-switch').click(function() {
              var displ = item.find('.accordion-content').css('display');
              item.closest('ul').find('.accordion-switch').each(function() {
                var li = jQuery(this).closest('li');
                li.find('.accordion-content').slideUp(300);
                jQuery(this).parent().removeClass("selected");
              });
              if (displ=="block") {
                item.find('.accordion-content').slideUp(300)
                item.removeClass("selected");
              } else {
                item.find('.accordion-content').slideDown(300)
                item.addClass("selected");
              }
            });
          });
        }
        /*----------------------------------------------------------*/
        /*CONTACT FORM JS */
        /*----------------------------------------------------------*/
        if ( $( 'form#contact-form' ).length && jQuery() ) {

          $('form#contact-form').submit(function() {
            function resetForm($form) {
              $form.find('input:text, input:password, input:file, select, textarea').val('');
              $form.find('input:radio, input:checkbox')
              .removeAttr('checked').removeAttr('selected');
            }
            $('form#contact-form .error').remove();
            var hasError = false;
            $('.requiredField').each(function() {
              if(jQuery.trim($(this).val()) == '') {
                var labelText = $(this).prev('label').text();
                $(this).parent().append('<div class="notification error"><p>Please enter '+labelText+'</p></div>');
                $(this).addClass('inputError');
                hasError = true;
              } else if($(this).hasClass('email')) {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!emailReg.test(jQuery.trim($(this).val()))) {
                  var labelText = $(this).prev('label').text();
                  $(this).parent().append('<div class="notification error"><p>You entered an invalid '+labelText+'</p></div>');
                  $(this).addClass('inputError');
                  hasError = true;
                }
              }
            });
            if(!hasError) {
              $('form#contact-form input.submit').fadeOut('normal', function() {
                $(this).parent().append('');
              });
              var formInput = $(this).serialize();
              $.post($(this).attr('action'),formInput, function(data){
                $('#contact-form').prepend('<div class="notification success"><p>Your email was successfully sent. We will contact you as soon as possible.</p></div>');
                resetForm($('#contact-form'));
                $('.success').fadeOut(5000);

              });
            }
            return false;
          });
        }
      });

 
