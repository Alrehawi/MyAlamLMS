<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('FileAdd', '_manage.php');
$max_file_size = "1000000";

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $user_admin = User::find_by_id($session->user_id);
    // assign new sort id

    $files = new File();
    @$files->title = trim($_POST['title']);
    @$files->attatch_file($_FILES['file_upload']);
    @$files->publish = 1;
    @$files->site_id = $session->site_id;
    @$files->created = current_date();

    if ($files->save_File()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New File: {$files->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php?" . trim($_POST['qs']));
    } else {
        $message = join("<br/>", $files->errors);
    }
}

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
                <h2><?php echo read_xmls('/site/file/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/file/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" name="photos" id="photos" enctype="multipart/form-data" action="_upload.php">
                          <?php echo setToken() ?>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/file/lables/file') ?></label>
                                <input type="file" name="file_upload[]" id="image_file" multiple >
                            </div>
                            <div class="form-group">
                               <div class="file_uploading" id="hidden">
                                    <?php echo show_icon('loading.gif', read_xmls('/site/adminactions/uploading'),'images'); ?>
                                </div>
                                <div id="uploaded_images_preview"></div>
                                  <input type="hidden" name="qs" value="<?php echo $_SERVER['QUERY_STRING']; ?>" />
                                  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
