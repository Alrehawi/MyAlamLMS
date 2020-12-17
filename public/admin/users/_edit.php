<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('UserEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}

$user = User::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);

if ($user_admin->role_id != 7){
  //check valid user to Edit
  $sql = "SELECT  u.*,a.site_id FROM roles a, users u WHERE a.id = u.role_id and u.id={$_GET['id']} and a.site_id={$session->site_id}";
  $chkUser = User::count_by_sql_stat($sql);
  if ($chkUser == false) {
    redirect_to("_manage.php");
  }
}

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $users = new User();
    $users->id = $_GET['id'];
    $users->role_id = $_POST['role_id'];
    $users->username = $user->username;
    if ($user->password == $_POST['password']) {
        //don't change the pass value
        $users->password = $_POST['password'];
    } else {
        //do the MD5 encription
        $users->password = trim(encrept($_POST['password']));
    }
    $users->email = trim($_POST['email']);
    $users->active_key = $user->active_key;
    $users->active_valid = $user->active_valid;
    $users->publish = $user->publish;
    $users->created = $user->created;
    $users->updated = current_date();

    if ($users->save_user($user->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update User: {$users->username} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $user->id);
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
                <h2><?php echo read_xmls('/site/users/titles/edit') ?>: <?php echo $user->username; ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/users/titles/manage') ?>
                    <i class="fa fa-edit margin-right-fivePx"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_edit.php?id=<?php echo $user->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <table width="80%" border="0" cellspacing="0" cellpadding="0">
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/roles/lables/name') ?></label>
                                    <select  class="form-control" name="role_id">
                                        <?php
                                        if ($user_admin->role_id == 7){
                                            $cond = "";
                                        } else if ($user_admin->role_id == 8){
                                          $cond = " WHERE id != 7 AND site_id={$session->site_id}  ";
                                        } else{
                                            $cond = " WHERE id != 7 and id={$user_admin->role_id} AND site_id={$session->site_id}  ";
                                        }
                                        $get_roles = Role::find_all("id ASC", $cond);
                                        foreach ($get_roles as $role) {
                                            ?>
                                            <option value="<?php echo $role->id ?>"<?php if ($user->role_id == $role->id) {
                                                echo ' selected';
                                            } ?>><?php echo $role->title ?></option>
                                      <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <tr>
                                    <td width="25%"><?php echo read_xmls('/site/users/lables/username') ?> :</td>
                                    <td width="75%"><?php echo $user->username; ?></td>
                                    </tr>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/users/lables/password') ?></label>
                                    <input class="form-control" type="password" name="password" value="<?php echo $user->password; ?>" autocomplete="off"/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/users/lables/email') ?></label>
                                    <input class="form-control" type="text" name="email" value="<?php echo $user->email; ?>" />
                                </div>
                                <div class="form-group">
                                    <tr>
                                    <td width="25%"><?php echo read_xmls('/site/adminactions/created') ?> :</td>
                                    <td width="75%"><?php echo $user->created; ?></td>
                                    </tr>
                                </div>
                                <div class="form-group">
                                   <tr>
                                    <td width="25%"><?php echo read_xmls('/site/adminactions/updated') ?> :</td>
                                    <td width="75%"><?php echo $user->updated; ?></td>
                                    </tr>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="button" />
                                </div>
                            </table>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
