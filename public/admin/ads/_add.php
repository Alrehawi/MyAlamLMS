<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('AdAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $user_admin = User::find_by_id($session->user_id);
    // assign new sort id
    $new_sort_id = Ad::count_new_sort_id("WHERE adsec_id=" . intval($_POST['adsec_id']));
    $ads = new Ad();
    @$ads->title = trim($_POST['title']);
    @$ads->content = trim($_POST['content']);
    // get default lang ID
    @$default_lang = Language::get_default_lang();
    @$ads->lang_id = $default_lang[0]->id;
    @$ads->publish = 1;
    @$ads->sort_id = $new_sort_id;
    @$ads->url = trim($_POST['url']);
    @$ads->target = trim($_POST['target']);
    @$ads->adsec_id = trim($_POST['adsec_id']);
    @$ads->ad_type = trim($_POST['ad_type']);
    @$ads->created = current_date();
    if ($_POST['ad_type'] == 'flash') {
        if (!empty($_FILES['photo']['name'])) {
            if (strstr($_FILES['photo']['type'], '/', false) == '/x-shockwave-flash') {
                $files = new File();
                @$files->title = trim($_POST['title']);
                @$files->attatch_file($_FILES['photo']);
                @$files->publish = 1;
                @$files->site_id = $session->site_id;
                @$files->created = current_date();

                if ($files->save_File()) {
                    echo log_action("Add New File: {$files->title} ", "By: {$user_admin->username}");
                } else {
                    $message = join("<br/>", $files->errors);
                }
                @$ads->photo = $files->id;
            } else {
                $session->message(read_xmls('/site/file/msg/notfile'));
                redirect_to("./_add.php");
            }
        }
    } else {
        if (!empty($_FILES['photo']['name'])) {
            if (strstr($_FILES['photo']['type'], '/', true) == 'image') {
                $new_photo_sort_id = Photographs::count_new_sort_id();
                @$photo = new Photographs();
                @$photo->caption = trim($_POST['title']);
                @$photo->sort_id = $new_photo_sort_id;
                @$photo->site_id = $session->site_id;
                @$photo->parent_type = Ad::$trans_key;
                @$photo->publish = 1;
                @$photo->max_width = 2000;
                @$photo->max_height = 2000;
                @$photo->max_width_thumb = 100;
                @$photo->max_height_thumb = 100;
                @$photo->attatch_file($_FILES['photo']);
            } else {
                $session->message(read_xmls('/site/photos/msg/notphoto'));
                redirect_to("./_add.php");
            }

            if ($photo->save_photo()) {
                echo log_action("Add New Photo: " . trim($_POST['title']), "By: {$user_admin->username}");
            } else {
                $session->message(join("<br/>", $photo->errors));
            }

            @$ads->photo = $photo->id;
        }
    }

    if ($ads->save_ad()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Ad: {$ads->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php?adsec_id=" . trim($_POST['adsec_id']));
    } else {
        $message = join("<br/>", $ads->errors);
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
                <h2><?php echo read_xmls('/site/ad/titles/add') ?></h2>
                <?php if ($session->has_permission('AdAdd')) { ?>
                    <a class="btn btn-primary pull-left margin-link"  href="_manage.php?adsec_id=<?php echo trim(@$_GET['adsec_id']) ?>"><?php echo read_xmls('/site/ad/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
                <?php } ?>
                <?php if ($session->has_permission('AdSectionView')) { ?>
                    <a class="btn btn-primary pull-left"  href="../ads_sections/_manage.php"><?php echo read_xmls('/site/adsec/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="form" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/ad/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" />
                                <?php echo read_xmls('/site/ad/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/ad/lables/content') ?></label>
                                <input class="form-control" type="text" name="content" value="<?php echo check_var("content", "POST"); ?>" maxlength="255" />
                                <?php echo read_xmls('/site/ad/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/ad/lables/url') ?></label>
                                <input class="form-control" name="url" type="text" id="url" value="<?php
                                    if (check_var("url", "POST"))
                                        echo $_POST['url'];
                                    else
                                        echo 'https://';
                                    ?>" maxlength="255" dir="ltr" />
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/ad/lables/target') ?></label>
                                <select  class="form-control" name="target">
                                    <option value="_self"<?php
                                    if (check_var("target", "POST") == '_self') {
                                        echo ' selected';
                                    }
                                    ?>><?php echo read_xmls('/site/ad/lables/self') ?></option>
                                    <option value="_blank"<?php
                                    if (check_var("target", "POST") == '_blank') {
                                        echo ' selected';
                                    }
                                    ?>><?php echo read_xmls('/site/ad/lables/blank') ?></option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/ad/lables/photo') ?></label>
                                <input class="form-control" name="photo" type="file" id="photo"/>
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/adsec/lables/name') ?></label>
                                <select  class="form-control" name="adsec_id">
                                    <?php
                                    //Get all Categories
                                    $adsecs = AdSection::find_all("title ASC","WHERE site_id={$session->site_id}");
                                    foreach ($adsecs as $adsec):
                                        ?>
                                        <option value='<?php echo $adsec->id; ?>'<?php
                                        if (@$_REQUEST['adsec_id'] == $adsec->id) {
                                            echo ' selected';
                                        }
                                        ?>><?php echo $adsec->title; ?></option>
                                   <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <label><input type="radio" name="ad_type" id="ad_type" value="image" checked="checked" />
                                <?php echo show_icon('image.png') ?></label>
                                <label><input type="radio" name="ad_type" id="ad_type" value="flash" />
                                 <?php echo show_icon('flash.png') ?></label>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>" class="button" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
