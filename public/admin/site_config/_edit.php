<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SiteConfigEdit', '../');

if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}

$site_config = SiteConfig::find_by_id($_GET['id']);
$count_all = SiteConfig::count_all();
$user_admin = User::find_by_id($session->user_id);

if($user_admin->role_id == 7){
  $config_id=$site_config->id;
} else {
  $config_id=$session->site_id;
  if($_GET['id'] != $session->site_id){
    redirect_to('_edit.php?id=' . $session->site_id);
  }
}

if (!empty($_GET['clear_logo_path']) && $session->check_permission('PhotoDelete', '_edit.php?id=' . $config_id)) {

    if (Photographs::check_file_exist($site_config->logo_path)) {
        $cur_photo = Photographs::find_by_id($site_config->logo_path);
        if ($cur_photo->id) {
            $cur_photo->destroy();
        }
    }
    SiteConfig::update_by_field('logo_path', 0, "WHERE id=" . $config_id);
    redirect_to('_edit.php?id=' . $config_id);
}

if (!empty($_GET['clear_slogan_path']) && $session->check_permission('PhotoDelete', '_edit.php?id=' . $config_id)) {

    if (Photographs::check_file_exist($site_config->slogan_path)) {
        $cur_photo = Photographs::find_by_id($site_config->slogan_path);
        if ($cur_photo->id) {
            $cur_photo->destroy();
        }
    }
    SiteConfig::update_by_field('slogan_path', 0, "WHERE id=" . $config_id);
    redirect_to('_edit.php?id=' . $config_id);
}

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $site_configs = new SiteConfig();
    @$site_configs->id = $_GET['id'];
    @$site_configs->title = trim($_POST['title']);
    @$site_configs->url_alias = trim($_POST['url_alias']);
    @$site_configs->lang_id = $_POST['lang_id'];
    if(@$_POST['default_site']==1){
        SiteConfig::update_by_field('default_site',0);
    }
    @$site_configs->default_site = $_POST['default_site'];
    @$site_configs->email = trim($_POST['email']);
    @$site_configs->offline = @$_POST['offline'];
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
    @$site_configs->elearning_link = $site_config->elearning_link;
    @$site_configs->school_dues_link = $site_config->school_dues_link;
    @$site_configs->registration_link = $site_config->registration_link;
    @$site_configs->jobs_link = $site_config->jobs_link;
    @$site_configs->live_broadcast_link = $site_config->live_broadcast_link;
    @$site_configs->counter = $site_config->counter;
    @$site_configs->publish = $site_config->publish;
    @$site_configs->updated = current_date();

	if (empty($_FILES['logo_path']['name'])) {
        $site_configs->logo_path = $site_config->logo_path;
    } else if (strstr($_FILES['logo_path']['type'], '/', true) != 'image') {
        $session->message(read_xmls('/site/photos/msg/notphoto'));
        redirect_to("_edit.php?id=" . $config_id);
    } else {
        //drop current photo
        if (!empty($site_config->logo_path) && Photographs::check_file_exist($site_config->logo_path)) {
            $cur_photo = Photographs::find_by_id($site_config->logo_path);
            if ($cur_photo->id) {
                $cur_photo->destroy();
            }
        }

        $new_sort_id = Photographs::count_new_sort_id();
        @$photo = new Photographs();
        @$photo->caption = trim($_POST['title']);
        @$photo->sort_id = $new_sort_id;
        @$photo->site_id = $session->site_id;
        @$photo->parent_type = SiteConfig::$trans_key;
        @$photo->publish = 1;
        @$photo->max_width = 1000;
        @$photo->max_height = 1000;
        @$photo->max_width_thumb = 100;
        @$photo->max_height_thumb = 100;
        @$photo->attatch_file($_FILES['logo_path']);

        if ($photo->save_photo()) {
            echo log_action("Add New Photo: {$site_configs->title}", "By: {$user_admin->username}");
        } else {
            $session->message(join("<br/>", $photo->errors));
        }
        $site_configs->logo_path = $photo->id;
    }

	if (empty($_FILES['slogan_path']['name'])) {
        $site_configs->slogan_path = $site_config->slogan_path;
    } else if (strstr($_FILES['slogan_path']['type'], '/', true) != 'image') {
        $session->message(read_xmls('/site/photos/msg/notphoto'));
        redirect_to("_edit.php?id=" . $config_id);
    } else {
        //drop current photo2
        if (!empty($site_config->slogan_path) && Photographs::check_file_exist($site_config->slogan_path)) {
            $cur_photo = Photographs::find_by_id($site_config->slogan_path);
            if ($cur_photo->id) {
                $cur_photo->destroy();
            }
        }

        $new_sort_id = Photographs::count_new_sort_id();
        @$photo = new Photographs();
        @$photo->caption = trim($_POST['title']);
        @$photo->sort_id = $new_sort_id;
        @$photo->site_id = $session->site_id;
        @$photo->parent_type = SiteConfig::$trans_key;
        @$photo->publish = 1;
        @$photo->max_width = 1000;
        @$photo->max_height = 1000;
        @$photo->max_width_thumb = 100;
        @$photo->max_height_thumb = 100;
        @$photo->attatch_file($_FILES['slogan_path']);

        if ($photo->save_photo()) {
            echo log_action("Add New Photo: {$site_configs->title}", "By: {$user_admin->username}");
        } else {
            $session->message(join("<br/>", $photo->errors));
        }
        $site_configs->slogan_path = $photo->id;
    }


    //update new record
    if ($site_configs->save_site_config($config_id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Site Config: {$site_configs->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $site_configs->id);
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
                <h2><?php echo read_xmls('/site/siteconfigs/titles/edit') ?>: <?php echo @$site_config->title; ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/siteconfigs/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="site_config" action="_edit.php?id=<?php echo $config_id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                                <div class="form-group">
                                    <label width="200"><?php echo read_xmls('/site/siteconfigs/lables/title') ?></label>
                                    <input type="text" class='form-control' name="title" value="<?php echo @$site_config->title; ?>" maxlength="255"/>
                                </div>
                                <div class="form-group">
                                    <label width="200"><?php echo read_xmls('/site/siteconfigs/lables/logo_path') ?></label>
                                    <input class='form-control' name="logo_path" type="file" id="logo_path"/>
                                        <?php if (!empty($site_config->logo_path)) { ?>
                                            <br />
                                            <a title="<?php echo $site_config->title; ?>" href="<?php echo Photographs::get_image($site_config->logo_path, 'larg'); ?>" target="_blank" id="single"><img src="<?php echo Photographs::get_image($site_config->logo_path, 'small'); ?>" width="50"></a> <a href="?id=<?php echo $config_id; ?>&clear_logo_path=do" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');"><?php echo read_xmls('/site/adminactions/delete') ?></a>
                                        <?php } ?>
                                    </td>
                                </div>
                                        <div class="form-group">
                                    <label width="200"><?php echo read_xmls('/site/siteconfigs/lables/slogan_path') ?></label>
                                    <input class='form-control' name="slogan_path" type="file" id="slogan_path"/>
                                        <?php if (!empty($site_config->slogan_path)) { ?>
                                            <br />
                                            <a title="<?php echo $site_config->title; ?>" href="<?php echo Photographs::get_image($site_config->slogan_path, 'larg'); ?>" target="_blank" id="single"><img src="<?php echo Photographs::get_image($site_config->slogan_path, 'small'); ?>" width="50"></a> <a href="?id=<?php echo $config_id; ?>&clear_slogan_path=do" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');"><?php echo read_xmls('/site/adminactions/delete') ?></a>
                                        <?php } ?>
                                    </td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/alias') ?></label>
                                    <input type="text" class='form-control' name="url_alias" value="<?php echo @$site_config->url_alias; ?>" maxlength='255' onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('default_language') ?></label>
                                    <select  class="form-control" name="lang_id">
                                      <?php
                                      $langs = Language::find_all();
                                      foreach($langs as $lang):
                                        ?>
                                        <option value="<?php echo $lang->id; ?>" <?php if(@$site_config->lang_id==$lang->id)echo ' selected'; ?>><?php echo $lang->title; ?></option>
                                      <?php endforeach;  ?>
                                    </select>

                                    </td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/email') ?></label>
                                    <input type="text" class='form-control' name="email" value="<?php echo @$site_config->email; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/phone') ?></label>
                                    <input type="text" class='form-control' name="phone" value="<?php echo @$site_config->phone; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/address') ?></label>
                                    <input type="text" class='form-control' name="address" value="<?php echo @$site_config->address; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/paging') ?></label>
                                    <input type="text" class='form-control' name="paging" value="<?php echo @$site_config->paging; ?>" maxlength="2" onkeypress='return isNumberKey(event)'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/facebook') ?></label>
                                    <input type="text" class='form-control' name="facebook" value="<?php echo @$site_config->facebook; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/twitter') ?></label>
                                    <input type="text" class='form-control' name="twitter" value="<?php echo @$site_config->twitter; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/youtube') ?></label>
                                    <input type="text" class='form-control' name="youtube" value="<?php echo @$site_config->youtube; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/flickr') ?></label>
                                    <input type="text" class='form-control' name="flickr" value="<?php echo @$site_config->flickr; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/googleplus') ?></label>
                                    <input type="text" class='form-control' name="google_plus"  value="<?php echo @$site_config->google_plus; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/linkedin') ?></label>
                                    <input type="text" class='form-control' name="linkedin"  value="<?php echo @$site_config->linkedin; ?>" maxlength='255'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/copyrights') ?></label>
                                    <input type="text" class='form-control' name="copyrights" value="<?php echo @$site_config->copyrights; ?>" maxlength="255"/>
                                </div>
                                <div class="form-group">
                                  <label><?php echo read_xmls('/site/siteconfigs/lables/background')?></label>
                                      <select class="form-control" name="backgrounds">
                                        <option value=""></option>
                                        <?php foreach(folder_content('backgrounds'.DSO,'.jpg') as $key=>$value): ?>
                                            <option value="<?php echo $key;?>" <?php if(@$site_config->backgrounds==$key)echo ' selected'; ?>><?php echo $value; ?></option>
                                        <?php endforeach;  ?>
                                      </select>

                                </div>

                                <div class="form-group">
                                  <input type="checkbox" name="offline" value="1" <?php if (@$site_config->offline == 1) echo "checked" ?>  onclick="showMe('offlinemsg')"/>
                                    <label valign="top"><?php echo read_xmls('/site/siteconfigs/lables/offline') ?></label>
                                        <br />
                                        <div id="offlinemsg" <?php if (@$site_config->offline == 0) echo " style='display:none;'" ?>> <br />
                                            <?php echo read_xmls('/site/siteconfigs/lables/offlinemsg') ?> <br />
                                            <?php
                                            $getValue = @$site_config->offline_msg;
                                            $getField = 'offline_msg';
                                            $getBaseFolder = '../../aids/ckeditor/';
                                            $getType = 'larg';
                                            include('../../aids/editor.php');
                                            ?>
                                        </div>
                                </div>
                            <div class="form-group">
                               <label> <?php echo read_xmls('/site/siteconfigs/lables/googleanalytics') ?></label>
                                <textarea class='form-control' name="google_analytics" cols="30" rows="5"><?php echo @$site_config->google_analytics; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/siteconfigs/lables/keywords') ?></label>
                                <textarea class='form-control' name="keywords" cols="30" rows="5"><?php echo @$site_config->keywords; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/siteconfigs/lables/description') ?></label>
                                <textarea class='form-control' name="description" cols="30" rows="5"><?php echo @$site_config->description; ?></textarea>
                            </div>
                            <div class="form-group">
                              <input type="checkbox" name="default_site" value="1" <?php if (@$site_config->default_site == 1) echo "checked" ?>/></td>
                              <label><?php echo read_xmls('default_site') ?></label>
                          </div>
                            <div class="form-group">
                              <input type="checkbox" name="show_lang" value="1" <?php if (@$site_config->show_lang == 1) echo "checked" ?>/>
                                <?php echo read_xmls('/site/siteconfigs/lables/showlang') ?></label>
                            </div>
                            <div class="form-group">
                              <input type="checkbox" name="show_sites" value="1" <?php if (@$site_config->show_sites == 1) echo "checked" ?>/>
                                <?php echo read_xmls('/site/siteconfigs/lables/showsites') ?></label>
                                </div>
                            <div class="form-group">
                              <input type="checkbox" name="seo" value="1" <?php if (@$site_config->seo == 1) echo "checked" ?>/>
                                <label><?php echo read_xmls('/site/siteconfigs/lables/seo') ?></label>
                            </div>
                            <div class="form-group">
                                <?php echo read_xmls('/site/siteconfigs/lables/updated') ?>
                                <?php echo @$site_config->updated; ?>
                            </div>
                            <div class="form-group">
                                <?php echo read_xmls('/site/siteconfigs/lables/counter') ?>
                                <?php echo @$site_config->counter; ?>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                    <?php if ($session->has_permission('SiteConfigTranslate')) { ?>
                                        <a  class="btn btn-info" href="_translate.php?parent=<?php echo $config_id; ?>" class="button"><?php echo read_xmls('/site/siteconfigs/lables/translate') ?></a>
                                    <?php } ?>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include_layout_template('admin_footer.php'); ?>
