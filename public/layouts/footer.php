<?php
global $session,$page_title,$showHeaderFooter;
?>
<?php if($showHeaderFooter){?>
  <footer>
  <div class="container">
    <div class="row">
      <!-- Column 1 Start -->
      <div class="col-md-3 col-sm-6 col-12">
        <h3><?php echo read_xmls('contact_us')?></h3>
        <div class="mt-25">
          <!-- <img src="images/img/logo-footer.png" alt="footer-logo"> -->
          <h5><i class="fa fa-phone"></i>&nbsp; <?php echo read_xmls('unified_number')?>  &nbsp; 1966</h5>
          <h5><i class="fa fa-phone-square"></i>&nbsp;<a href="./?page=<?php echo Page::getField(29,'url_alias');?>"><?php echo Page::getField(29,'title');?></a></h5>
          <h5><i class="fa fa-users"></i>&nbsp;<?php echo read_xmls('follow_us')?></h5>

          <div class="footer-social-icons mt-25">
            <ul>
              <li><a href="<?php echo @SiteConfig::site_config('facebook'); ?>" target="_blank" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
              <li><div class="dropdown"><a title="twitter"><span><i class="fa fa-twitter"></i></span></a>
                <div class="dropdown-content-footer">
                  <div class="icon"><a  href="<?php echo @SiteConfig::site_config('twitter'); ?>" target="_blank" title="الإبتدائية"><i class="fa fa-twitter"></i> <span><?php echo read_xmls('primary')?></span></a></div>
                  <div class="icon"><a   href="<?php echo @SiteConfig::site_config('google_plus'); ?>" target="_blank" title="المتوسطة"><i class="fa fa-twitter"></i> <span><?php echo read_xmls('intermediate')?></span></a></div>
                  <div class="icon"><a   href="<?php echo @SiteConfig::site_config('linkedin'); ?>" target="_blank" title="الثانوية"><i class="fa fa-twitter"></i> <span><?php echo read_xmls('secondary')?></span></a></div>
                </div></div></li>
              <li><a href="<?php echo @SiteConfig::site_config('flickr'); ?>" target="_blank" title="Instgram"><i class="fa fa-instagram"></i></a></li>
              <li><a href="<?php echo @SiteConfig::site_config('youtube'); ?>" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Column 1 End -->

      <!-- Column 2 Start -->
      <div class="col-md-3 col-sm-6 col-12">
        <h3><?php echo Menu::getField(335,'title');?></h3>
        <ul class="footer-list">
          <?php
            $menus_top = Menu::get_childrens(335,1);
            foreach ($menus_top as $menu_top):
          ?>
            <li><i class="<?php echo $menu_top->font_icon?>"></i>
              <a  <?php echo Menu::generate_link($menu_top->id)?>><?php echo Menu::find_viewed_language("title", $menu_top->id, Menu::$trans_key)?> </a>
            </li>
          <?php endforeach; ?>

        </ul>
      </div>
      <!-- Column 2 End -->

      <!-- Column 3 Start -->
      <div class="col-md-3 col-sm-6 col-12">
        <h3><?php echo Menu::getField(336,'title');?></h3>
        <ul class="footer-list">
          <?php
            $menus_top = Menu::get_childrens(336,1);
            foreach ($menus_top as $menu_top):
          ?>
            <li><i class="<?php echo $menu_top->font_icon?>"></i>
              <a  <?php echo Menu::generate_link($menu_top->id)?>><?php echo Menu::find_viewed_language("title", $menu_top->id, Menu::$trans_key)?> </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <!-- Column 3 End -->

      <!-- Column 4 Start -->
      <div class="col-md-3 col-sm-6 col-12">
        <h3><?php echo read_xmls('download_app')?></h3>
        <br>
        <div class="row">

        <div class="col-lg-7">
        <h5><a href="#" target="_blank" title="<?php echo read_xmls('alharameen_app_iphone')?>"><img src="images/img/ios.png" width="120"></a></h5>
          <h5>
          <a href="#" target="_blank" title="<?php echo read_xmls('alharameen_app_android')?>"><img src="images/img/android.png"  width="120"></a></h5>
        </div>
        </div>

      </div>
      <!-- Column 4 End -->
    </div>

    <!-- Footer Bar Start -->
    <div class="footer-bar">

      <div class="row">
      <div class="col-md-10">
        <p><?php echo @SiteConfig::find_viewed_language('copyrights', $session->site_id, SiteConfig::$trans_key); ?>&nbsp;
           </a></p>
      </div>
      <div class="col-md-2">
        <p><?php echo read_xmls('/site/siteconfigs/lables/counter').": ".@SiteConfig::site_config('counter'); ?></p>
      </div>
      </div>
    </div>
    <!-- Footer Bar End -->
  </div>
</footer>
<!-- Start   Footer -->

<!-- Scroll to top button Start -->
<a href="#" class="scroll-to-top"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
<!-- Scroll to top button End -->

<?php }?>



<?php
    echo get_js('jquery.min.js');
    echo get_js('popper.min.js');
    echo get_js('popper.min.js');
    echo get_js('bootstrap.min.js');
    echo get_js('owl.carousel.js');
    echo get_js('navigation.js');
    echo get_js('navigation.fixed.js');
    echo get_js('wow.min.js');
    echo get_js('jquery.counterup.min.js');
    echo get_js('waypoints.min.js');
    echo get_js('tabs.min.js');
    echo get_js('jquery.mb.YTPlayer.min.js');
    echo get_js('swiper.min.js');
    echo get_js('isotope.pkgd.min.js');
    echo get_js('switcher.js');
    echo get_js('modernizr.js');
    echo get_js('map.js');
    echo get_js('main.js');

    echo get_js('revolution/jquery.themepunch.tools.min.js');
    echo get_js('revolution/jquery.themepunch.revolution.min.js');
    echo get_js('revolution/revolution.addon.slicey.min.js?ver=1.0.0');
    echo get_js('revolution/revolution.extension.actions.min.js');
    echo get_js('revolution/revolution.extension.kenburn.min.js');
    echo get_js('revolution/revolution.extension.layeranimation.min.js');
    echo get_js('revolution/revolution.extension.migration.min.js');
    echo get_js('revolution/revolution.extension.slideanims.min.js');

///////////////////////////////////////////////////////////////////////
    echo get_js('new_front/OwlCarousl/owl.carousel.min.js');
    echo get_js('new_front/js/cdn.js');
    echo get_js('new_front/js/navigation.js');
    echo get_js('new_front/js/navigation-script.js');
    echo get_js('new_front/js/script.js');
    echo get_js('new_front/index.js');


    echo get_js('global.js');
    echo get_js('general.js');
    echo get_js('custom.js');
    echo get_js('prettyPhoto.min.js');
    echo get_js('new_front/js/select.js');

    echo get_js('tour/hopscotch.js');
    //echo get_js('tour/tour.js');



?>

<script>
    $('select').addClass('select');
    $('select').attr('data-live-search', true);
</script>

</body>
</html>

<!-- START .Google Analytics -->
<?php echo @SiteConfig::site_config('google_analytics'); ?>
<!-- END .Footer -->

<?php
if (isset($database)) {
    $database->close_connection();
}
?>
<?php ob_flush(); ?>
