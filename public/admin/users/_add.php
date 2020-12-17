<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('UserAdd', '_manage.php');
?>
<?php
$user_admin = User::find_by_id($session->user_id);
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $users = new User();
    $users->username = trim(strtolower($_POST['username']));
    $users->password = trim(encrept($_POST['password']));
    $users->email = trim($_POST['email']);
    $users->role_id = $_POST['role_id'];

    $users->active_key = 0; // Waiting for improvement
    $users->active_valid = 1; // Waiting for improvement
    $users->publish = 1;
    $users->created = current_date();

    if ($users->save_user()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New User: {$users->username} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $users->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/users/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/users/titles/manage') ?>
                    <i class="fa fa-edit margin-right-fivePx"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/roles/lables/name') ?></label>
                                <td>
                                    <select  class="form-control" name="role_id">
                                        <?php
                                        $user = User::find_by_id($session->user_id);
                                        if ($user->role_id == 7)
                                            $cond = "";
                                        else
                                            $cond = " WHERE id != 7 AND site_id={$session->site_id} ";
                                        $get_roles = Role::find_all("id ASC", $cond);
                                        foreach ($get_roles as $role) {
                                            ?>
                                            <option value="<?php echo $role->id ?>"><?php echo $role->title ?></option>
                                    <?php } ?>
                                    </select>   </td>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/users/lables/username') ?></label>
                                <input type="text" class="form-control" name="username" value="<?php echo check_var("username", "POST"); ?>"  onKeyUp="javascript:checkInvalidChars(this);"/>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/users/lables/password') ?></label>
                                <input  type="password" class="form-control" name="password" autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/users/lables/email') ?></label>
                                <input type="text" class="form-control" name="email" value="<?php echo check_var("email", "POST"); ?>" />
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>" class="button" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
