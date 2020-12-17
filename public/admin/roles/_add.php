<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('RoleAdd', '_manage.php');
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $roles = new Role();
    $roles->title = trim($_POST['title']);
    if ($user_admin->role_id == 7) {
        $roles->site_id = $_POST['site_id'];
    } else {
        $roles->site_id = $session->site_id;
    }
    if ($roles->save_role()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Role: {$roles->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $roles->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>

<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/roles/titles/add') ?></h2>
                <a class="btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/roles/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/roles/lables/name') ?></label>
                                    <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" onKeyUp="javascript:checkInvalidChars(this);"/>
                                    <?php echo read_xmls('/site/part/lables/charnum') ?>
                                </div>
                                <div class="form-group">
                                     <?php
                                        if ($user_admin->role_id == 7) {
                                            ?>
                                            <label> <?php echo read_xmls('/site/roles/lables/site') ?></label>
                                            <select  class="form-control" name="site_id">
                                                <?php
                                                $sites = SiteConfig::find_all("title ASC");
                                                foreach ($sites as $site):
                                                    ?>
                                                    <option value='<?php echo $site->id; ?>'<?php
                                                    if (@$_REQUEST['site_id'] == $site->id) {
                                                        echo ' selected';
                                                    }
                                                    ?>><?php echo $site->title; ?></option>
                                                        <?php endforeach; ?>
                                            </select>
                                        <?php } ?>
                                </div>
                                <div class="form-group">
                                  <input class="btn btn-primary"  type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"/>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
