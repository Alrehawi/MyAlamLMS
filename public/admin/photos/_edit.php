<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PhotoEdit', '_manage.php?photo_sec=admin');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php?photo_sec=admin");
}
$max_file_size = "1000000";
$current_photo = Photographs::find_by_id($_GET['id'], " AND site_id={$session->site_id}");
$user = User::find_by_id($session->is_logged_in());
if (check_var('submit', "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $photo = new Photographs();
    $photo->id = $current_photo->id;
    $photo->sort_id = $current_photo->sort_id;
    $photo->publish = $current_photo->publish;
    $photo->site_id = $current_photo->site_id;
    $photo->caption = trim($_POST['caption']);
    $photo->filename = $current_photo->filename;
    $photo->type = $current_photo->type;
    $photo->size = $current_photo->size;
    $photo->parent_type = $current_photo->parent_type;

    //$photo->attatch_file($_FILES['file_upload']);

    if ($photo->save_photo()) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Edit A photo: {$photo->caption}", "By: {$user->username}");
        redirect_to("_edit.php?id=" . $photo->id);
    } else {
        $message = join("<br/>", $photo->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h2><?php echo read_xmls('/site/photos/titles/edit') ?>: <?php echo $current_photo->caption ?></h2>
                        <a class="btn btn-primary pull-left" href="_manage.php?photo_sec=admin"><?php echo read_xmls('/site/photos/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
                        <form style="margin-top: 10px" name="photos" action="_edit.php?id=<?php echo $current_photo->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>">
                        <!--    <p>Select File: <input type="file" name="file_upload"></p>-->
                            <div class="form-group">
                                <input class="form-control" type="text" name="caption" value="<?php echo $current_photo->caption; ?>">
                                <input style="margin-top: 10px" class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
