<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PermissionAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $user_admin = User::find_by_id($session->user_id);
    $pers = new Permission();
    $pers->title = trim($_POST['title']);
    $pers->persec_id = trim($_POST['persec_id']);
    $pers->page_path = trim($_POST['page_path']);

    if ($pers->save_per()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Permission: {$pers->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
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
                <h2><?php echo read_xmls('/site/perms/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/perms/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                     <form name="photos" action="_add.php" method="POST" enctype="multipart/form-data">

                       <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/perms/lables/name') ?></label>
                                <input  class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" onkeyup="javascript:checkInvalidChars(this);" />
                                    <?php echo read_xmls('/site/perms/lables/charnum') ?></td>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/persecs/lables/name') ?></label>
                                    <select  class="form-control" name="persec_id">
                                        <?php
                                        $persecs = PerSec::find_all();
                                        foreach ($persecs as $persec):
                                            ?>
                                            <option value='<?php echo $persec->id; ?>'<?php
                                            if (check_var("persec_id", "POST") == $persec->id) {
                                                echo ' selected';
                                            }
                                            ?>><?php echo $persec->title; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/perms/lables/pagepath') ?></label>
                                <input  class="form-control" type="text" name="page_path" value="<?php echo check_var("page_path", "POST"); ?>" maxlength="255"  dir="ltr"/>
                                    <?php echo read_xmls('/site/perms/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
