<?php
require_once("../includes/initialize.php");
global $session;
if (SiteConfig::site_config('offline') == 0) {
    redirect_to('./');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 9]>
<?php echo get_js('global.js'); ?>
<![endif]-->
<html xmlns="https://www.w3.org/1999/xhtml" lang="<?php echo Language::check_alias();?>">
<head>
  <title><?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key)?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=8" />
  <?php if (SiteConfig::site_config('seo') == 1) { ?>
    <meta name="keywords" content="<?php echo SiteConfig::find_viewed_language('keywords', $session->site_id, SiteConfig::$trans_key) . @$page_keywords ?>" />
    <meta name="description" content="<?php echo SiteConfig::find_viewed_language('description', $session->site_id, SiteConfig::$trans_key) . @$page_desc ?>" />
  <?php } ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=IE8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="shortcut icon" href="<?php echo show_icon('favicon.ico', '', 'images/img', false) ?>" />

  <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
  <?php
  global $session;
  echo get_css(Language::get_lang_style());
  echo get_css('new_admin/vendor/font-awesome/css/font-awesome.min.css');
  //echo get_css('new_front/css/Home-Page.css');
  echo get_css('new_front/select.css');
  //echo get_css('tour/flat-ui.css');
  echo get_css('tour/hopscotch.min.css');
  //echo get_css('tour/tour.css');

  //echo get_css('new_front/front_ar.css');
  ?>


        <?php echo SiteConfig::find_viewed_language('offline_msg', $session->site_id, SiteConfig::$trans_key) ?>


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
    echo get_js('tour/tour.js');



?>
