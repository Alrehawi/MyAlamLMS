<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('AdEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$ad = Ad::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $ads = new Ad();
    @$ads->id = $_GET['id'];
    @$ads->title = trim($_POST['title']);
    @$ads->content = trim($_POST['content']);
    @$ads->ad_type = trim($_POST['ad_type']);
    @$ads->lang_id = $ad->lang_id;
    @$ads->publish = $ad->publish;
    @$ads->sort_id = $ad->sort_id;
    @$ads->url = trim($_POST['url']);
    @$ads->target = trim($_POST['target']);
    @$ads->adsec_id = trim($_POST['adsec_id']);
    @$ads->created = $ad->created;
    @$ads->updated = current_date();

    if ($_POST['ad_type'] == 'flash') {
        if (empty($_FILES['photo']['name'])) {
            $ads->photo = $ad->photo;
        } else if (strstr($_FILES['photo']['type'], '/', false) != '/x-shockwave-flash') {
            $session->message(read_xmls('/site/file/msg/notfile'));
            redirect_to("_edit.php?id=" . $ad->id);
        } else {
            //drop current photo
            if (!empty($ad->photo)) {
                @$cur_photo = File::find_by_id($ad->photo);
                if ($cur_photo->id && Photographs::check_file_exist($cur_photo->photo)) {
                    $cur_photo->destroy();
                }
            }
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
        }
    } else {
        //ads object
        if (empty($_FILES['photo']['name'])) {
            $ads->photo = $ad->photo;
        } else if (strstr($_FILES['photo']['type'], '/', true) != 'image') {
            $session->message(read_xmls('/site/photos/msg/notphoto'));
            redirect_to("_edit.php?id=" . $ad->id);
        } else {
            //drop current photo
            if (!empty($ad->photo)) {
                @$cur_photo = Photographs::find_by_id($ad->photo);
                if ($cur_photo->id) {
                    $cur_photo->destroy();
                }
            }
            $new_sort_id = Photographs::count_new_sort_id();
            @$photo = new Photographs();
            @$photo->caption = trim($_POST['title']);
            @$photo->sort_id = $new_sort_id;
            @$photo->site_id = $session->site_id;
            @$photo->parent_type = Ad::$trans_key;
            @$photo->publish = 1;
            @$photo->max_width = 1040;
            @$photo->max_height = 1040;
            @$photo->max_width_thumb = 100;
            @$photo->max_height_thumb = 100;
            @$photo->attatch_file($_FILES['photo']);

            if ($photo->save_photo()) {
                echo log_action("Add New Photo: {$ads->title}", "By: {$user_admin->username}");
            } else {
                $session->message(join("<br/>", $photo->errors));
            }
            $ads->photo = $photo->id;
        }
    }

    if ($ads->save_ad($ad->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Ad: {$ads->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $ad->id);
    } else {
        $message = join("<br/>", $ads->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<script>
    $(function () {
        $('#thumbs').load('../../aids/getThumb.php?thumb=<?php echo $ad->photo ?>');
    });

    $(document).ready(function () {
        $("a#single").fancybox({
            'opacity': true,
            'overlayShow': true,
            'overlayColor': '#333',
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'titlePosition': 'over'
        });
    });
</script>
  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/plugin/titles/add') ?></h2>
                <a class="btn btn-primary pull-left margin-link" href="_manage.php?adsec_id=<?php echo $ad->adsec_id ?>"><?php echo read_xmls('/site/ad/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
                <?php if ($session->has_permission('AdTranslate')) { ?>
                    <a class="btn btn-info pull-left" href="_translate.php?parent=<?php echo @$ad->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?><i class="fa fa-language margin-right-fivePx"></i></a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="ad" action="_edit.php?id=<?php echo $ad->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/ad/lables/name') ?></label>
                                 <input class="form-control" type="text" name="title" value="<?php echo $ad->title; ?>" maxlength="255">
                                <?php echo read_xmls('/site/ad/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/ad/lables/content') ?></label>
                                 <input class="form-control" type="text" name="content" value="<?php echo $ad->content; ?>" maxlength="255">
                                <?php echo read_xmls('/site/ad/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/ad/lables/url') ?></label>
                                <input class="form-control" name="url" type="text" id="url" value="<?php echo $ad->url; ?>" maxlength="255" dir="ltr" />
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/ad/lables/target') ?></label>
                                <select  class="form-control" name="target">
                                    <option value="_self"<?php
                                    if ($ad->target == '_self') {
                                        echo ' selected';
                                    }
                                    ?>><?php echo read_xmls('/site/ad/lables/self') ?></option>
                                    <option value="_blank"<?php
                                    if ($ad->target == '_blank') {
                                        echo ' selected';
                                    }
                                    ?>><?php echo read_xmls('/site/ad/lables/blank') ?></option>

                                </select>
                            </div>
                            <div class="form-group">
                                 <label><?php echo read_xmls('/site/ad/lables/photo') ?></label>
                                <input class="form-control" name="photo" type="file" id="photo"/><br>
                                    <?php
                                    if (!empty($ad->photo)) {
                                        if ($ad->ad_type == 'flash') {
                                            echo "<a href='" . File::get_file($ad->photo) . "' target='_blank'>" . show_icon('flash.png') . "</a>";
                                        } else {
                                            ?>
                                            <a title="<?php echo $ad->title; ?>" href="<?php echo Photographs::get_image($ad->photo, 'larg'); ?>" id="single"><img src="<?php echo Photographs::get_image($ad->photo, 'small'); ?>" alt="" width="50" /></a>
                                            <?php }
                                        } ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/adsec/lables/name') ?></label>
                                <select  class="form-control" name="adsec_id">
                                    <?php
                                    //Get all Categories
                                    $adsecs = AdSection::find_all("title ASC","WHERE site_id={$session->site_id}");
                                    foreach ($adsecs as $adsec):
                                        ?>
                                                            <option value='<?php echo $adsec->id; ?>'<?php if ($ad->adsec_id == $adsec->id) {
                                            echo ' selected';
                                        } ?>><?php echo $adsec->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>&nbsp;</label>
                                <label><input type="radio" name="ad_type" id="ad_type" value="image"<?php if ($ad->ad_type == 'image') echo ' checked="checked"'; ?> />
                                <?php echo show_icon('image.png') ?></label>
                                <label><input type="radio" name="ad_type" id="ad_type" value="flash"<?php if ($ad->ad_type == 'flash') echo ' checked="checked"'; ?>/>
                                <?php echo show_icon('flash.png') ?></label>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
