<?php
require_once("../includes/initialize.php");
global $session;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
echo get_css(Language::get_lang_style());
echo get_css('new_admin/vendor/font-awesome/css/font-awesome.min.css');
//echo get_css('new_front/css/Home-Page.css');
echo get_css('new_front/select.css');
//echo get_css('tour/flat-ui.css');
echo get_css('tour/hopscotch.min.css');
//echo get_css('tour/tour.css');

//echo get_css('new_front/front_ar.css');
?>

<div class="error-box">
  <div class="back-box">
    <h2><?php echo read_xmls('/site/msg/error404');?></h2>
  </div>
  <div class="error-box-text">
    <h1>404</h1>
    <h3><?php echo read_xmls('/site/msg/pagenotfound');?></h3>
    <h4><?php echo read_xmls('/site/msg/errormsg');?></h4>
    <div class="mt-30">
      <a href="./" class="dark-button button-md"><?php echo read_xmls('/site/msg/backhome');?></a>
    </div>
  </div>
</div>
