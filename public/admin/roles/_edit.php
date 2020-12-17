<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('RoleEdit', '_manage.php');
$user_admin = User::find_by_id($session->user_id);
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
if ($user_admin->role_id == 7) {
    $role = Role::find_by_id($_GET['id']);
} else {
    $role = Role::find_by_id($_GET['id'], " AND site_id={$session->site_id}");
    $checkRole = Role::count_all(" WHERE id={$_GET['id']} AND site_id={$session->site_id} ");
    if ($checkRole == false) {
      redirect_to("_manage.php");
    }
}


if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $roles = new Role();
    $roles->id = $_GET['id'];
    $roles->title = trim($_POST['title']);
    if ($user_admin->role_id == 7) {
        $roles->site_id = $_POST['site_id'];
    } else {
        $roles->site_id = $role->site_id;
    }
    $roles->site_id = $_POST['site_id'];

    if ($roles->save_role($role->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Role: {$roles->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $role->id);
    } else {
        $message = join("<br/>", $roles->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/roles/titles/edit') ?> : <?php echo $role->title; ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/roles/titles/manage') ?>
                    <i class="fa fa-th-list margin-right-fivePx"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="role" action="_edit.php?id=<?php echo $role->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label> <?php echo read_xmls('/site/roles/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo $role->title; ?>" maxlength="255" onKeyUp="javascript:checkInvalidChars(this);">
                            </div>
                            <?php
                            if ($user_admin->role_id == 7) {
                                ?>
                                <div class="form-group">
                                    <label> <?php echo read_xmls('/site/roles/lables/site') ?></label>
                                        <select  class="form-control" name="site_id">
                                            <?php
                                            $sites = SiteConfig::find_all("title ASC");
                                            foreach ($sites as $site):
                                                ?>
                                                <option value='<?php echo $site->id; ?>'<?php
                                                if ($role->site_id == $site->id) {
                                                    echo ' selected';
                                                }
                                                ?>>
                                                <?php echo $site->title; ?>
                                                </option>
                                             <?php endforeach; ?>
                                        </select>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/></td>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
