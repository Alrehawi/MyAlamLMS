<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MediaEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$media = Media::find_by_id($_GET['id']);

$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $medias = new Media();
    @$medias->id = $_GET['id'];
    @$medias->title = trim($_POST['title']);

    //manage sort_id when changing section
    if ($media->media_type == 'youtube' && $media->gallery_id != $_POST['gallery_id']) {
        $new_sort_id = Media::count_new_sort_id(" WHERE gallery_id=" . $_POST['gallery_id']);
        @$medias->sort_id = $new_sort_id;
    } else {
        @$medias->sort_id = $media->sort_id;
    }
    if ($media->media_type == 'image' || $media->media_type == 'video' ||$media->media_type == 'audio') {
        @$medias->gallery_id = $media->gallery_id;
    } else {
        @$medias->gallery_id = trim($_POST['gallery_id']);
    }
    @$medias->type = $media->type;
    @$medias->size = $media->size;
    @$medias->filename = $media->filename;
    @$medias->media_type = $media->media_type;
    @$medias->width = trim($_POST['width']);
    @$medias->height = trim($_POST['height']);
    @$medias->url = trim($_POST['url']);

    $medias->lang_id = $media->lang_id;
    if (empty($media->file_id)) {
        @$medias->file_id = 'Null';
    } else {
        @$medias->file_id = $media->file_id;
    }
    @$medias->publish = $media->publish;
    @$medias->created = $media->created;
    @$medias->updated = current_date();

    if ($medias->media_type == 'youtube') {
        if ($medias->save_video($media->id)) {
            $session->message(read_xmls('/site/msg/sucupdate'));
            echo log_action("Update Media: {$medias->title} ", "By: {$user_admin->username}");
            redirect_to("_edit.php?id=" . $media->id);
        } else {
            $message = join("<br/>", $medias->errors);
        }
    } else {
        if ($medias->save_media($media->id)) {
            $session->message(read_xmls('/site/msg/sucupdate'));
            echo log_action("Update Media: {$medias->title} ", "By: {$user_admin->username}");
            redirect_to("_edit.php?id=" . $media->id);
        } else {
            $message = join("<br/>", $medias->errors);
        }
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<script>
    $(function () {
        $('#thumbs').load('../../aids/getThumb.php?thumb=<?php echo $media->photo ?>');
    });
</script>
  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/media/titles/edit') ?>: <?php echo $media->title; ?></h2>
                <a class="btn btn-primary pull-left margin-link" href="_manage.php?gallery_id=<?php echo $media->gallery_id ?>"><?php echo read_xmls('/site/media/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
                <?php if ($session->has_permission('MediaTranslate')) { ?>
                    <a class="btn btn-info pull-left" href="_translate.php?parent=<?php echo $media->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?><i class="fa fa-language margin-right-fivePx"></i></a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="ad" action="_edit.php?id=<?php echo $media->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/media/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo $media->title; ?>" maxlength="255">
                                    <?php echo read_xmls('/site/media/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <?php if ($media->media_type == 'youtube') { ?>
                                    <label><?php echo read_xmls('/site/gallery/lables/name') ?></label>
                                    <select name="gallery_id">
                                        <?php
                                        //Get all Galleries
                                        $gallerys = Gallery::find_all("title ASC","WHERE site_id={$session->site_id}");
                                        foreach ($gallerys as $gallery):
                                            ?>
                                            <option value='<?php echo $gallery->id; ?>'<?php
                                            if ($media->gallery_id == $gallery->id) {
                                                echo ' selected';
                                            }
                                            ?>><?php echo $gallery->title; ?></option>
                                                <?php endforeach; ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/media/lables/link') ?></label>
                                <input class="form-control" type="text" name="url" value="<?php echo $media->url ?>" maxlength="100" />
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/media/lables/width') ?></label>
                               <input type="text" name="width" maxlength="3"   onkeypress='return isNumberKey(event)' style="width:30%" value="<?php echo $media->width ?>"/>
                                X
                                <input type="text" name="height" maxlength="3" onkeypress='return isNumberKey(event)' style="width:30%" value="<?php echo $media->height ?>"/>
                                <label>[PX] <?php echo read_xmls('/site/media/lables/height') ?></label>
                            </div>
                            <?php } ?>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
