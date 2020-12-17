<?php
require_once("../includes/initialize.php");
global $database, $session;

if (isset($_GET['site'])) {
  $getsite=$_GET['site'];
  $siteConfig = SiteConfig::find_by_field('url_alias', $database->escape_value($getsite));
  if (!empty($siteConfig[0]->id)) {
    $session->site_id=$siteConfig[0]->id;
    $session->site_id($siteConfig[0]->id);
    redirect_to_js(Page::get_home_link('index_default_check'));
    exit;
  }

} else {

  if(!isset($session->site_id) || empty($session->site_id)){

    $siteConfig = SiteConfig::find_by_field("default_site" , "1");
    $session->site_id=$siteConfig[0]->id;
    $session->site_id($siteConfig[0]->id);

    if(!empty($_SERVER["QUERY_STRING"])){
      redirect_to(FILE_RELATIVES.'/?'.$_SERVER["QUERY_STRING"]);
    }
    else{
      redirect_to(FILE_RELATIVES.'/?site='.$siteConfig[0]->url_alias);
      //redirect_to(Page::get_home_link('index_default_check'));

    }
  }
}

?>
<?php echo include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>
<?php

switch (isset($_GET)) {

//PAGES----------------------------------------

    case isset($_GET['page']):
        if ($_GET['page'] && Page::count_by_field('url_alias', $_GET['page'])) {
            $page = Page::find_by_field('url_alias', $_GET['page']);
            if ($page[0]->site_id != $session->site_id) {
                $session->site_id($page[0]->site_id);
                redirect_to(FILE_RELATIVE.'/?page=' . $page[0]->url_alias);
            }

            echo include_layout_template('page.php');
        } else {
            redirect_to(Page::get_home_link('index_page_check'));
        }
        break;
    case isset($_GET['module']):
        if ($_GET['module'] && Module::count_by_field('url_alias', $_GET['module'])) {
            $module = Module::find_by_field('url_alias', $_GET['module']);
            if ($module[0]->site_id != $session->site_id) {
                $session->site_id($module[0]->site_id);
                redirect_to(FILE_RELATIVE.'/?' . $_SERVER['QUERY_STRING']);
            }
            echo include_layout_template('module.php');
        } else {
            redirect_to(Page::get_home_link('index_module_check'));
        }
        break;

    case isset($_GET['do_register']):
        echo include_action_file('register.php');
        break;
    case isset($_GET['logout']):
        echo include_action_file('logout.php');
        break;
    default:
    redirect_to_js(Page::get_home_link('index_default_check'));
    exit;
    //echo include_layout_template('home.php');
}
?>
<?php echo include_layout_template('footer.php'); ?>
