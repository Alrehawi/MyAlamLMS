<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('FileEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$file = File::find_by_id($_GET['id']," AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $files = new File();
    @$files->id = $_GET['id'];
    @$files->title = trim($_POST['title']);
    @$files->filename = $file->filename;
    @$files->type = $file->type;
    @$files->size = $file->size;
    @$files->publish = $file->publish;
    @$files->site_id = $file->site_id;
    @$files->created = $file->created;
    @$files->updated = current_date();
    if ($files->save_File($file->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update File: {$files->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $file->id);
    } else {
        $message = join("<br/>", $files->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/file/titles/edit') ?>: <?php echo $file->title; ?></h2>
                 <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/file/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="file" action="_edit.php?id=<?php echo $file->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/file/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo $file->title; ?>" maxlength="250">
                            </div>
                            <div class="form-group">
                                <input style="margin-top: 10px" class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
