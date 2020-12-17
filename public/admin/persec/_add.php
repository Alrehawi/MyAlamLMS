<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PerSecAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }  
    $user_admin = User::find_by_id($session->user_id);
    $persecs = new PerSec();
    $persecs->title = trim($_POST['title']);

    if ($persecs->save_persec()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Permission Section: {$persecs->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $persecs->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/persecs/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/persecs/titles/manage') ?>
                    <i class="fa fa-th-list margin-right-fivePx"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                       <form name="photos" action="_add.php" method="POST" enctype="multipart/form-data">
                         <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/persecs/lables/name') ?>:*
                                <input type="text" class="form-control" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255"> <?php echo read_xmls('/site/persecs/lables/charnum') ?></label>

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
