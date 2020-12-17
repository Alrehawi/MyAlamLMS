<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SiteConfigAdd', '../');
?>
<?php
$site_config = SiteConfig::find_all();
$site_config = @$site_config[0];
$count_all = SiteConfig::count_all();
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $site_configs = new SiteConfig();
    @$site_configs->title = trim($_POST['title']);
    @$site_configs->url_alias = trim($_POST['url_alias']);
    @$site_configs->lang_id = $_POST['lang_id'];
    if(@$_POST['default_site']==1){
        SiteConfig::update_by_field('default_site',0);
    }
    @$site_configs->default_site = $_POST['default_site'];
    @$site_configs->email = trim($_POST['email']);
    @$site_configs->offline = $_POST['offline'];
    @$site_configs->offline_msg = trim($_POST['offline_msg']);
    @$site_configs->seo = $_POST['seo'];
    @$site_configs->paging = $_POST['paging'];
    @$site_configs->show_lang = $_POST['show_lang'];
    @$site_configs->show_sites = $_POST['show_sites'];
    @$site_configs->google_analytics = trim($_POST['google_analytics']);
    @$site_configs->keywords = trim($_POST['keywords']);
    @$site_configs->description = trim($_POST['description']);
    @$site_configs->facebook = trim($_POST['facebook']);
    @$site_configs->twitter = trim($_POST['twitter']);
    @$site_configs->youtube = trim($_POST['youtube']);
    @$site_configs->copyrights = trim($_POST['copyrights']);
    @$site_configs->backgrounds = trim($_POST['backgrounds']);
    @$site_configs->flickr = trim($_POST['flickr']);
    @$site_configs->google_plus = trim($_POST['google_plus']);
    @$site_configs->linkedin = trim($_POST['linkedin']);
    @$site_configs->phone = trim($_POST['phone']);
    @$site_configs->address = trim($_POST['address']);
    @$site_configs->counter = $site_config->counter;
    @$site_configs->publish = 1;
    @$site_configs->updated = current_date();

	if (!empty($_FILES['logo_path']['name'])) {
        if (strstr($_FILES['logo_path']['type'], '/', true) == 'image') {
            $new_photo_sort_id = Photographs::count_new_sort_id();
            @$photo = new Photographs();
            @$photo->caption = trim($_POST['title']);
            @$photo->sort_id = $new_photo_sort_id;
            @$photo->site_id = $session->site_id;
            @$photo->parent_type = SiteConfig::$trans_key;
            @$photo->publish = 1;
            @$photo->max_width = 1000;
            @$photo->max_height = 1000;
            @$photo->max_width_thumb = 100;
            @$photo->max_height_thumb = 100;
            @$photo->attatch_file($_FILES['logo_path']);
        } else {
            $session->message(read_xmls('/site/photos/msg/notphoto'));
            redirect_to("./_add.php");
        }

        if ($photo->save_photo()) {
            echo log_action("Add New Photo: " . trim($_POST['title']), "By: {$user_admin->username}");
        } else {
            $session->message(join("<br/>", $photo->errors));
        }

        @$site_configs->logo_path = $photo->id;
    }

	if (!empty($_FILES['slogan_path']['name'])) {
        if (strstr($_FILES['slogan_path']['type'], '/', true) == 'image') {
            $new_photo_sort_id = Photographs::count_new_sort_id();
            @$photo = new Photographs();
            @$photo->caption = trim($_POST['title']);
            @$photo->sort_id = $new_photo_sort_id;
            @$photo->site_id = $session->site_id;
            @$photo->parent_type = SiteConfig::$trans_key;
            @$photo->publish = 1;
            @$photo->max_width = 1000;
            @$photo->max_height = 1000;
            @$photo->max_width_thumb = 100;
            @$photo->max_height_thumb = 100;
            @$photo->attatch_file($_FILES['slogan_path']);
        } else {
            $session->message(read_xmls('/site/photos/msg/notphoto'));
            redirect_to("./_add.php");
        }

        if ($photo->save_photo()) {
            echo log_action("Add New Photo: " . trim($_POST['title']), "By: {$user_admin->username}");
        } else {
            $session->message(join("<br/>", $photo->errors));
        }

        @$site_configs->slogan_path = $photo->id;
    }

    //add new record
    if ($site_configs->save_site_config()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add Site Config: {$site_configs->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $site_configs->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>

  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/siteconfigs/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/siteconfigs/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="site_config" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/title') ?></label>
                                    <input type="text" class='form-control' name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255"/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/logo_path') ?></label>
                                    <input class='form-control' name="logo_path" type="file" id="logo_path"/></td>
                                </div>
                                        <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/slogan_path') ?></label>
                                    <input class='form-control' name="slogan_path" type="file" id="slogan_path"/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/alias') ?></label>
                                    <input type="text" class='form-control' name="url_alias" value="<?php echo check_var("url_alias", "POST"); ?>" maxlength='255' onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('default_language') ?></label>
                                    <select  class="form-control" name="lang_id">
                                      <?php
                                      $langs = Language::find_all();
                                      foreach($langs as $lang): ?>
                                        <option value="<?php echo $lang->id; ?>" <?php if(check_var("lang_id", "POST")==$lang->id)echo ' selected'; ?>><?php echo $lang->title; ?></option>
                                      <?php endforeach;  ?>
                                    </select>

                                    </td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/email') ?></label>
                                    <input type="text" class='form-control' name="email" value="<?php echo check_var("email", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/phone') ?></label>
                                    <input type="text" class='form-control' name="phone" value="<?php echo check_var("phone", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/address') ?></label>
                                    <input type="text" class='form-control' name="address" value="<?php echo check_var("address", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/paging') ?></label>
                                    <input type="text" class='form-control' name="paging" value="<?php echo check_var("paging", "POST"); ?>" maxlength="2" onkeypress='return isNumberKey(event)'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/facebook') ?></label>
                                    <input type="text" class='form-control' name="facebook" value="<?php echo check_var("facebook", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/twitter') ?></label>
                                    <input type="text" class='form-control' name="twitter" value="<?php echo check_var("twitter", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/youtube') ?></label>
                                    <input type="text" class='form-control' name="youtube" value="<?php echo check_var("youtube", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/flickr') ?></label>
                                    <input type="text" class='form-control' name="flickr" value="<?php echo check_var("flickr", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/googleplus') ?></label>
                                    <input type="text" class='form-control' name="google_plus" value="<?php echo check_var("google_plus", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/linkedin') ?></label>
                                    <input type="text" class='form-control' name="linkedin" value="<?php echo check_var("linkedin", "POST"); ?>" maxlength='255'/></td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/copyrights') ?></label>
                                    <input type="text" class='form-control' name="copyrights" value="<?php echo check_var("copyrights", "POST"); ?>" maxlength="255"/></td>
                                </div>
                                <div class="form-group">
                                  <label><?php echo read_xmls('/site/siteconfigs/lables/background');?></label>
                                      <select  class="form-control" name="backgrounds">
                                        <?php foreach(folder_content('backgrounds'.DSO,'.jpg') as $key=>$value): ?>
                                          <option value="<?php echo $key; ?>" <?php if(@$site_config->backgrounds==$key)echo ' selected'; ?>><?php echo $value; ?></option>
                                        <?php endforeach;  ?>
                                      </select>
                                </div>

                                <div class="form-group">

                                    <input type="checkbox" name="offline" value="1" <?php if (check_var("offline", "POST") == 1) echo "checked" ?> onclick="showMe('offlinemsg')"/>
                                        <label valign="top"><?php echo read_xmls('/site/siteconfigs/lables/offline') ?></label>
                                        <br />
                                        <div id="offlinemsg" <?php if (check_var("offline", "POST") == 0) echo " style='display:none;'" ?>> <br />
                                            <?php echo read_xmls('/site/siteconfigs/lables/offlinemsg') ?> <br />
                                            <?php
                                            $getValue = "";
                                            $getField = 'offline_msg';
                                            $getBaseFolder = '../../aids/ckeditor/';
                                            $getType = 'larg';
                                            include('../../aids/editor.php');
                                            ?>
                                        </div>
                                </div>

                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/googleanalytics') ?></label>
                                    <textarea class='form-control' name="google_analytics" cols="30" rows="5"><?php echo check_var("google_analytics", "POST"); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/keywords') ?></label>
                                    <textarea class='form-control' name="keywords" cols="30" rows="5"><?php echo check_var("keywords", "POST"); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/description') ?></label>
                                    <textarea class='form-control' name="description" cols="30" rows="5"><?php check_var("description", "POST"); ?></textarea>
                                </div>
                                <div class="form-group">
                                  <input type="checkbox" name="default_site" value="1" <?php if (check_var("default_site", "POST") == 1) echo "checked" ?>/></td>
                                  <label><?php echo read_xmls('default_site') ?></label>
                              </div>
                                  <div class="form-group">
                                    <input type="checkbox" name="show_lang" value="1" <?php if (check_var("show_lang", "POST") == 1) echo "checked" ?>/></td>
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/showlang') ?></label>
                                </div>
                                <div class="form-group">
                                  <input type="checkbox" name="show_sites" value="1" <?php if (check_var("show_sites", "POST") == 1) echo "checked" ?>/></td>
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/showsites') ?></label>
                                </div>
                                <div class="form-group">
                                  <input type="checkbox" name="seo" value="1" <?php if (check_var("seo", "POST") == 1) echo "checked" ?>/></td>
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/seo') ?></label>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="button"/>
                                </div>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
