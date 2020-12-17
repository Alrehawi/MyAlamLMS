<?php
ob_start();
global $database, $page_title, $session, $showHeaderFooter;
$showHeaderFooter=true;
if (isset($_GET['mobile'])) {
  $showHeaderFooter=false;
}

if (SiteConfig::site_config('offline') == 1) {
  redirect_to('close.php');
}

if (empty($session->visitor)) {
  SiteConfig::increase_counter(1, "id={$session->site_id}");
  $session->visitor($_COOKIE[ini_get('session.name')]);
}

$divider = "";
if (isset($_GET['page']) && !empty($_GET['page']) && Page::count_by_field('url_alias', $_GET['page'])) {
  @$divider = " | ";
  @$page = Page::find_by_field('url_alias', $database->escape_value($_GET['page']));
  @$page = $page[0]->id;
  @$page_title = Page::find_viewed_language('title', $page, Page::$trans_key);
  @$page_keywords = "," . Page::find_viewed_language('keywords', $page, Page::$trans_key);
  @$page_desc = "," . Page::find_viewed_language('description', $page, Page::$trans_key);
} else if (isset($_GET['subject']) && !empty($_GET['subject']) && Subject::count_by_field('url_alias', $_GET['subject'])) {
  @$divider = " | ";
  @$subject = Subject::find_by_field('url_alias', $database->escape_value($_GET['subject']));
  @$subject = $subject[0]->id;
  @$page_title = Subject::find_viewed_language('title', $subject, Subject::$trans_key);
  @$page_keywords = "," . Subject::find_viewed_language('keywords', $subject, Subject::$trans_key);
  @$page_desc = "," . Subject::find_viewed_language('description', $subject, Subject::$trans_key);
} else if (isset($_GET['gallery']) && !empty($_GET['gallery']) && Gallery::count_by_field('url_alias', $_GET['gallery'])) {
  @$divider = " | ";
  @$subject = Gallery::find_by_field('url_alias', $database->escape_value($_GET['gallery']));
  @$subject = $subject[0]->id;
  @$page_title = Gallery::find_viewed_language('title', $subject, Gallery::$trans_key);
} else if (isset($_GET['module']) && !empty($_GET['module']) && Module::count_by_field('url_alias', $_GET['module'])) {
  @$divider = " | ";
  @$module = Module::find_by_field('url_alias', $database->escape_value($_GET['module']));
  @$module = $module[0]->id;
  @$page_title = Module::find_viewed_language('title', $module, Module::$trans_key);
  @$page_keywords = "," . Module::find_viewed_language('keywords', $module, Module::$trans_key);
  @$page_desc = "," . Module::find_viewed_language('description', $module, Module::$trans_key);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo Language::check_alias();?>">
<head>
  <title><?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key) . $divider . @$page_title ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=8" />
  <?php if (SiteConfig::site_config('seo') == 1) { ?>
    <meta name="keywords" content="<?php echo SiteConfig::find_viewed_language('keywords', $session->site_id, SiteConfig::$trans_key) . @$page_keywords ?>" />
    <meta name="description" content="<?php echo SiteConfig::find_viewed_language('description', $session->site_id, SiteConfig::$trans_key) . @$page_desc ?>" />
  <?php } ?>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <meta http-equiv="X-UA-Compatible" content="IE=IE8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="shortcut icon" href="<?php echo FILE_RELATIVE?>/images/img/fav.ico" />

  <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
  <?php
  global $session;
  $font=@Language::current_lang_attribute('font');
  if(!$font){     $font="AlegreyaSans-Regular.otf";  }
  echo "<style>@font-face {    font-family: myFirstFont;  src: url(".FILE_RELATIVE."/stylesheets/fonts/".$font.");  }</style>";
  echo get_css(Language::get_lang_style());
  echo get_css('new_admin/vendor/font-awesome/css/font-awesome.min.css');
  //echo get_css('new_front/css/Home-Page.css');
  echo get_css('new_front/select.css');
  //echo get_css('tour/flat-ui.css');
  echo get_css('tour/hopscotch.min.css');
  //echo get_css('tour/tour.css');

  //echo get_css('new_front/front_ar.css');
  ?>
  <!-- Fonts Google -->

</head>
<body>
  <?php if($showHeaderFooter){?>

    <!-- Preloader Start-->
    <!-- <div id="preloader">
      <div class="row loader">
        <div class="loader-icon"></div>
      </div>
    </div> -->
    <!-- Preloader End -->
    <!-- Top-Bar START -->
    <div id="top-bar">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-12">

            <div class="top-bar-info  col-lg-7 col-md-7">
              <ul>

                 <?php
                   $menus_top = Menu::get_childrens(331,1);
                   foreach ($menus_top as $menu_top):
                 ?>
                 <li><i class="<?php echo $menu_top->font_icon;?>"></i>
                   <a  class="primary-color" <?php echo Menu::generate_link($menu_top->id)?>><?php echo Menu::find_viewed_language("title", $menu_top->id, Menu::$trans_key)?> </a>
                 </li>
               <?php endforeach;?>

                 <?php if(SiteConfig::site_config('show_sites') == 1){ ?>
                 <!-- /.dropdown -->
   							<li class="dropdown">
                  <i class="fa fa-flag"></i>
   									<a class="dropdown-toggle primary-color"  data-toggle="dropdown" href="#">
                        <?php
                        $lang=Language::find_by_field('alias',$session->alias);
                        echo $lang[0]->title?>

   									</a>

   									<ul class="dropdown-menu  user-menu">
   										<?php
   										$sites=SiteConfig::find_all('id ASC' , " where publish=1 and id != {$session->site_id}");

   										foreach($sites as $site):?>
                        <li ><a href="#" class="primary-color" onclick="location.href='<?php echo search_for_flag(get_current_page(), 'site', $site->url_alias)?>'"><?php echo Language::getField($site->lang_id,'title',false);?></a></li>
   										<?php endforeach;?>
   									</ul>
   									<!-- /.dropdown-user -->
   							</li>
   						 <!-- /.dropdown -->
             <?php }?>

              </ul>
            </div>
            <div class="search-container col-lg-5 col-md-5">
              <!-- logo-search -->
                <form  name="search" action="./?module=<?php echo Module::find_alias('module_search.php'); ?>" method="get" id="searchform" >
                    <input type="hidden" name="module" value="<?php echo Module::find_alias('module_search.php'); ?>" />
                    <button type="submit" class="primary-color"><i class="fa fa-search "></i></button>
                    <input type="text" id="searchs" name="search" value="<?php if (@$_GET['search']) { echo @trim($_GET['search']);}  ?>" placeholder="<?php echo read_xmls('/site/frontend/search/search');?>"/>
                    <input type="hidden" name="submit" value="Search" />
                </form>
            </div>
          </div>




          <div class="col-md-3 col-12">
            <ul class="social-icons hidden-md-down">
              <li><a href="<?php echo @SiteConfig::site_config('facebook'); ?>" target="_blank" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
              <li><div class="dropdown"><a href="#" title="twitter"><span><i class="fa fa-twitter"></i></span></a>
                <div class="dropdown-content">
                  <div class="icon"><a  href="<?php echo @SiteConfig::site_config('twitter'); ?>" target="_blank" title="الإبتدائية"><i class="fa fa-twitter"></i> <?php echo read_xmls('primary')?></a></div>
                  <div class="icon"><a   href="<?php echo @SiteConfig::site_config('google_plus'); ?>" target="_blank" title="المتوسطة"><i class="fa fa-twitter"></i> <?php echo read_xmls('intermediate')?></a></div>
                  <div class="icon"><a   href="<?php echo @SiteConfig::site_config('linkedin'); ?>" target="_blank" title="الثانوية"><i class="fa fa-twitter"></i> <?php echo read_xmls('secondary')?></a></div>
                </div></div></li>
              <li><a href="<?php echo @SiteConfig::site_config('flickr'); ?>" target="_blank" title="Instgram"><i class="fa fa-instagram"></i></a></li>
              <li><a href="<?php echo @SiteConfig::site_config('youtube'); ?>" target="_blank" title="Youtube"><i class="fa fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Top-Bar END -->


    <!-- Navbar START -->
    <header style="background: url(<?php echo show_icon(SiteConfig::site_config('backgrounds'), '', 'backgrounds', false) ?>) FIXED center !important;">
      <nav id="navigation4" class="container navigation">
        <div class="row" style="margin:0;">
          <div class="col-lg-8 col-md-9 col-12">
            <div class="nav-header">
              <a  href="./"><img class="main-logo" alt="logo" id="main_logo"  title="<?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key) ?>" src="<?php echo Photographs::get_image(SiteConfig::site_config('logo_path'), 'larg'); ?>" style="height:110px"></a>
              <div class="nav-toggle"></div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-12 vision2030 hidden-sm-down">
            <img  src="<?php echo Photographs::get_image(SiteConfig::site_config('slogan_path'), 'larg'); ?>" >
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="nav-menus-wrapper">
              <ul class="nav-menu align-to-right">
                <?php
                $menus_top = Menu::get_childrens(156,1);
                foreach ($menus_top as $menu_top):
                  ?>
                  <li>
                    <a <?php echo Menu::generate_link($menu_top->id)?>><?php echo Menu::find_viewed_language("title", $menu_top->id, Menu::$trans_key)?> </a>
                  </li>
                <?php endforeach; ?>
                <?php echo Menu::get_children("Null",1); ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <!-- Navbar END -->



<!-- <div class="predcramp">
    <div class="container">
        <ul>
          <?php //include('layouts/plugins/plugin_navigation.php'); ?>
        </ul>
    </div>
</div> -->
<?php } ?>
