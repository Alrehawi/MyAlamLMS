<?php
ob_start();
global $session;
if(isset($_GET['change_site'])){
	$change_site = intval($_GET['change_site']);
	SiteConfig::change_default_site($change_site);
	redirect_to('./');
}
if (empty($session->site_id)) {
	$siteConfig = SiteConfig::find_all("id ASC limit 1");
	$session->site_id($siteConfig[0]->id);
    redirect_to('./');
}
if(isset($session->user_id)){
	//get user site_id
	$user_role=User::find_by_id($session->user_id);
	if($user_role->role_id <> '7'){
		$role_site = Role::find_by_id($user_role->role_id);
		if($role_site->site_id != $session->site_id){
			$session->site_id($role_site->site_id);
	    redirect_to('./');
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="https://www.w3.org/1999/xhtml" lang="<?php echo strtolower(read_xmls('/site/adminheader/lang')) ?>">
    <head>
        <title>
			<?php if (!empty($session->site_id)) {
				echo @SiteConfig::find_viewed_language('title', $session->site_id, 'config') . " | ";
			} ?>
            <?php echo read_xmls('/site/adminheader/cpanel'); ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
			  <link rel="shortcut icon" href="<?php echo FILE_RELATIVE?>/images/img/fav.ico" />
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <?php
        echo get_js('general.js');
        echo get_js('date_mask.js');
        echo get_js('ajax.js');
        echo get_css('admin_style.php');
        echo get_js('gallery' . DS . 'jquery.mousewheel-3.0.4.pack.js');
        echo get_js('gallery' . DS . 'jquery.fancybox-1.3.4.pack.js');
        echo get_css('gallery' . DS . 'jquery.fancybox-1.3.4.css');

        ?>

        <script> var jQuery_1_3_2 = $.noConflict(true);</script>
        <?php
				$font=@Language::current_lang_attribute('font');
				if(!$font){     $font="AlegreyaSans-Regular.otf";  }
			  echo "<style>@font-face {    font-family: 'myFirstFont';  src: url(".FILE_RELATIVE."/stylesheets/fonts/".$font.");  }</style>";
                  /* new css files */
        echo get_js('new_admin/vendor/jquery/jquery.min.js');
        echo get_js('new_admin/vendor/bootstrap/js/bootstrap.min.js');
        echo get_js('new_admin/dist/js/sb-admin-2.js');
        echo get_js('new_admin/vendor/datatables/js/jquery.dataTables.min.js');
        echo get_js('new_admin/vendor/datatables-plugins/dataTables.bootstrap.min.js');
        echo get_js('new_admin/vendor/datatables-responsive/dataTables.responsive.js');
        echo get_js('new_admin/vendor/raphael/raphael.min.js');
        echo get_js('new_admin/vendor/morrisjs/morris.js');
        echo get_js('new_admin/data/morris-data.js');
        echo get_js('new_admin/select.js');
        echo get_js('new_admin/admin.js');
            /* new css files */
        echo get_css('new_admin/select.css');
        echo get_css('new_admin/vendor/bootstrap/css/bootstrap.min.css');
        echo get_css('new_admin/vendor/metisMenu/metisMenu.min.css');
        echo get_css('new_admin/dist/css/sb-admin-2.css');
        echo get_css('new_admin/vendor/font-awesome/css/font-awesome.min.css');
        echo get_css('new_admin/vendor/datatables-responsive/dataTables.responsive.css');
        echo get_css('new_admin/vendor/datatables-plugins/dataTables.bootstrap.css');
        echo get_css('new_admin/'.read_xmls('/site/config/admincssfilename').'.css');

        ?>

         <script>
               jQuery_1_3_2('tr :checkbox').live('click', function () {
               jQuery_1_3_2(this).closest('tr').toggleClass('cli');
            });

        </script>
    </head>
    <body>
        <div id="wrapper">
        <?php
        if (check_var("user_id", "SESSION")) {
            $user = User::find_by_id($_SESSION['user_id']);
            $admin_name =  read_xmls('/site/adminlogin/msg/welcome') . ": {$user->username} \ {$user->title()}";
        } else {
            $admin_name = "";
        }
        ?>


         <?php if ($session->is_logged_in()) { ?>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand hidden-xs pull-right" href="<?php echo get_relative_link(ADMIN) ?>"><span><?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key);?></span></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-left">
                 <li >
									 <a  title="<?php echo read_xmls('/site/adminmenu/links/home')?>" href="<?php echo get_relative_link()?>" target="_blank">
									 	<i class="fa fa-home"></i>
										<?php echo read_xmls('/site/adminmenu/links/home')?>
							 		</a>
								 </li>
								 <?php if(SiteConfig::site_config('show_lang') == 1){?>
								 <!-- /.dropdown -->
                 <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-flag fa-fw"></i>
												 <?php echo Language::current_lang_attribute('title');?>
												 <i class="fa fa-caret-down"></i>
                     </a>

                     <ul class="dropdown-menu  user-menu">
											 <?php
											 $langs=Language::get_lang_links();

											 foreach($langs as $lang):?>
                         <li><?php echo $lang?></li>
											 <?php endforeach;?>
                     </ul>
                     <!-- /.dropdown-user -->
                 </li>
                <!-- /.dropdown -->
							<?php }?>

							<?php if($user_role->role_id == 7){?>
							<!-- /.dropdown -->
							<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">
											<i class="fa fa-retweet fa-fw"></i>
											<?php echo limit_words(SiteConfig::getField($session->site_id,'title'),2);?>
											<i class="fa fa-caret-down"></i>
									</a>

									<ul class="dropdown-menu  user-menu">
										<?php
										$sites=SiteConfig::find_all('id ASC' , " where publish=1 and id != {$session->site_id}");

										foreach($sites as $site):?>
											<li><a href="<?php echo search_for_flag(get_current_page(), 'change_site', $site->id)?>"><?php echo $site->title?></a></li>
										<?php endforeach;?>
									</ul>
									<!-- /.dropdown-user -->
							</li>
						 <!-- /.dropdown -->
					 <?php }?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
										<?php
										$lang=Language::get_target_lang();
										?>
                    <ul class="dropdown-menu  user-menu">
											<li><a href="#"> <?php echo $admin_name?></a></li>
                        <li><a href="<?php echo get_relative_link(ADMIN . DS . 'users/_edit.php?id='.$session->user_id)?>"><i class="fa fa-user fa-fw"></i>&nbsp; <?php echo read_xmls('/site/adminmenu/links/profile')?></a></li>
                        <li><a href="<?php echo get_relative_link(ADMIN . DS . 'site_config/_edit.php?id='.$session->site_id)?>"><i class="fa fa-gear fa-fw"></i>&nbsp; <?php echo read_xmls('/site/adminmenu/links/settings')?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo get_relative_link(ADMIN . DS . 'login/logout.php')?>"><i class="fa fa-sign-out fa-fw"></i>&nbsp; <?php echo read_xmls('/site/adminmenu/links/logout')?></a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation" id="sidebar">
							<div class="logoDashboard">
								<img src="<?php echo Photographs::get_image(SiteConfig::site_config('logo_path'), 'larg'); ?>"  title="<?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key) ?>" alt="<?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key) ?>">
							</div>
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <span class="input-group-btn">
                                  <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                  </button>
                                </span>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                            <!-- /input-group -->
                        </li>

                        <li>
                             <?php include_layout_template('admin_menu.php'); ?>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


              <!-- Content -->
        <div id="page-wrapper" style="margin-top: 0px; padding-top: 20px">
       <?php } ?>
