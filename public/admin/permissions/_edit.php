<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PermissionEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$per = Permission::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $pers = new Permission();
    $pers->id = $_GET['id'];
    $pers->title = trim($_POST['title']);
    $pers->persec_id = trim($_POST['persec_id']);
    $pers->page_path = trim($_POST['page_path']);

    if ($pers->save_per($per->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Permission: {$pers->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $per->id);
    } else {
        $message = join("<br/>", $pers->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/perms/titles/edit') ?>: <?php echo $per->title; ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/perms/titles/manage') ?>
                    <i class="fa fa-edit margin-right-fivePx"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      <form name="permission" action="_edit.php?id=<?php echo $per->id; ?>" method="POST" enctype="multipart/form-data">
                        <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/perms/lables/name') ?></label>
                                <input type="text" class="form-control" name="title" value="<?php echo $per->title; ?>" maxlength="255" onkeyup="javascript:checkInvalidChars(this);" />
                                    <?php echo read_xmls('/site/perms/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/persecs/lables/name') ?></label>
                                <select  class="form-control" name="persec_id">
                                        <?php
                                        //Get all Categories
                                        $persecs = PerSec::find_all();
                                        foreach ($persecs as $persec):
                                            ?>
                                            <option value='<?php echo $persec->id; ?>'<?php
                                            if ($per->persec_id == $persec->id) {
                                                echo ' selected';
                                            }
                                            ?>><?php echo $persec->title; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/perms/lables/pagepath') ?></label>
                                <input type="text" class="form-control" name="page_path" value="<?php echo $per->page_path; ?>" maxlength="255"  dir="ltr"/>
                                    <?php echo read_xmls('/site/perms/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="button" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
