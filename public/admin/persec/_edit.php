<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PerSecEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$persec = PerSec::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }  
    $persecs = new PerSec();
    $persecs->id = $_GET['id'];
    $persecs->title = trim($_POST['title']);

    if ($persecs->save_persec($persec->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Permission Section: {$persecs->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $persec->id);
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
                <h2><?php echo read_xmls('/site/persecs/titles/edit') ?>: <?php echo $persec->title; ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/persecs/titles/manage') ?>
                    <i class="fa fa-th-list margin-right-fivePx"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="permission" action="_edit.php?id=<?php echo $persec->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                               <label> <?php echo read_xmls('/site/persecs/lables/name') ?></label>
                                <input type="text" class="form-control" name="title" value="<?php echo $persec->title; ?>" maxlength="255">
                            </div>
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
