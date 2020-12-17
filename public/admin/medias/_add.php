<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MediaAdd', '_manage.php');
if (!isset($_GET['gallery_id']) || !Gallery::count_by_field('id', $_GET['gallery_id'])) {
    $session->message(read_xmls('/site/gallery/msg/detrmingallery'));
    redirect_to("../galleries/_manage.php");
} else {
    $gallery_id = intval($_GET['gallery_id']);
    $gallery = Gallery::find_by_id($gallery_id,"and site_id={$session->site_id}");
}
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST") && @$_POST['media_type'] == 'youtube') {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $new_sort_id = Media::count_new_sort_id(" WHERE gallery_id=" . $gallery->id);
    $default_lang = Language::get_default_lang();
    $medias = new Media();
    @$medias->title = trim($_POST['title']);
    @$medias->gallery_id = trim($_POST['gallery_id']);
    @$medias->media_type = trim($_POST['media_type']);
    @$medias->width = trim($_POST['width']);
    @$medias->height = trim($_POST['height']);
    @$medias->url = trim($_POST['url']);
    @$medias->file_id = "Null";

    @$medias->lang_id = $default_lang[0]->id;
    @$medias->sort_id = $new_sort_id;
    @$medias->publish = 1;
    @$medias->created = current_date();

    if ($medias->save_video()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add Media: {@$medias->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php?gallery_id=" . $gallery->id);
    } else {
        $message = join("<br/>", $medias->errors);
    }
}
?>
<?php
include_layout_template('admin_header.php');
echo get_js('upload_multi' . DS . 'jquery.min.js');
echo get_js('upload_multi' . DS . 'bootstrap.min.js');
echo get_js('upload_multi' . DS . 'jquery.form.js');
echo get_js('upload_multi' . DS . 'upload.js');
?>
  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/media/titles/add') ?>: <?php echo Gallery::find_viewed_language('title', $gallery_id, Gallery::$trans_key) ?></h2>
                <a class="btn btn-primary pull-left"  href="_manage.php?gallery_id=<?php echo $gallery_id ?>"><?php echo read_xmls('/site/media/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" name="photos" id="photos" enctype="multipart/form-data" action="_upload.php?gallery_id=<?php echo $gallery_id ?>">
                          <?php echo setToken() ?>
                            <div class="form-group">
                               <div id="add">
                                    <label><?php echo read_xmls('/site/media/lables/youtube'); ?>: </label>
                                    <input type="radio" name="media_type" value="1" onclick="getData('_add_video.php?gallery_id=<?php echo $gallery_id ?>', 'add'); change_action('photos','_add.php?gallery_id=<?php echo $gallery_id ?>');"/></label>
                                    <br />
                                    <br />

                                    <label><?php echo read_xmls('/site/media/lables/upload') ?> </label>
                                    <input class="form-control" type="file" name="file_upload[]" id="image_file" multiple>

                                    <!-- Show thumbs after upload -->
                                    <div class="form-control" class="file_uploading" id="hidden">
                                        <?php echo show_icon('loading.gif', read_xmls('/site/adminactions/uploading'),'images'); ?>
                                    </div>
                                    <div id="uploaded_images_preview"><i class="small"> jpg,png,jpeg,gif,mp4,avi,wmv,asf,flv,mp3 and rm</i></div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
