<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('RoleAssign', '..' . DS . 'roles' . DS . '_manage.php');
if (!isset($_GET['id'])) {
    $session->message(read_xmls('/site/msg/noid'));
    redirect_to("./");
}

//developer role
$user = User::find_by_id($session->user_id);
if ($user->role_id == 7) {
    $cond = "";
    $hidepermissec = "";
} else {
    $cond = " WHERE id <>7 AND site_id={$session->site_id}";
    $hidepermissec = " WHERE id <>4 ";
}
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
  
    $user_admin = User::find_by_id($session->user_id);
    $per2role = new Per2role();
    @$per2role->roles_id = $_POST['drop'];
    @$per2role->pers_id = check_var('perms_check', 'POST');
    @$get_role = Role::find_by_id($per2role->roles_id);

    if (@$per2role->save_per2role()) {
        $session->message(read_xmls('/site/msg/assigned'));
        echo log_action("Assignment Role: {$get_role->title} ", "By: {$user_admin->username}");
        @redirect_to("./per2role_assign.php?id=" . $per2role->roles_id);
    } else {
        $message = join("<br/>", $per2role->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/per2rol/titles/assign') ?></h2>
                <?php if ($session->has_permission('RoleView')) { ?>
                  <a class=" btn btn-primary pull-left" href="<?php echo get_relative_link(ADMIN . DS . 'roles' . DS . '_manage.php') ?>"><?php echo read_xmls('/site/roles/titles/manage') ?></a>
                <?php } ?>
                <?php if ($session->has_permission('PermissionView')) { ?>
                    <a class=" btn btn-primary pull-left" href="<?php echo get_relative_link(ADMIN . DS . 'permissions' . DS . '_manage.php') ?>"><?php echo read_xmls('/site/perms/titles/manage') ?></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" name="assign"  method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr>
                                <td width="15%" valign="top"><?php echo read_xmls('/site/roles/lables/name'); ?>:</td>
                                <td width="85%" valign="top">
                                    <select  class="form-control" name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'id', ''); ?>')">
                                        <?php
                                        $get_roles = Role::find_all("id ASC", $cond);
                                        foreach ($get_roles as $role) {
                                            ?>
                                            <option value="<?php echo $role->id ?>"<?php
                                            if (check_var('id', 'GET') == $role->id) {
                                                echo ' selected';
                                            }
                                            ?>><?php echo $role->title ?></option>
                                                <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                               <tr>
                                <td valign="top" colspan='2'><h2><label><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /> <?php echo read_xmls('/site/perms/lables/name'); ?></label></h2>
                                </td>
                            </tr>
                            <?php
                            $persecs = PerSec::find_all("id ASC", $hidepermissec);
                            foreach ($persecs as $persec):
                                echo "<tr>
                                        <td colspan='2' class='permission_td'>";
                                $perms_check = '';
                                $get_perms = Permission::find_by_field("persec_id", $persec->id, "ASC");
                                $i = 0;
                                foreach ($get_perms as $perms):
                                    $i++;
                                    if ($user->role_id == 7 || ($user->role_id != 7 && $session->has_permission($perms->title))) {
                                        if ($i == 1) {
                                            echo "<h3>{$persec->title}: </h3>";
                                        }
                                        echo "<div style='float:" . read_xmls('/site/config/align') . ";width:30%; height:30px;'><label><input type='checkbox' value='" . $perms->id . "' name='perms_check[]' title='" . $perms->title . "'";
                                        if (Per2role::is_checked(check_var('id', 'GET'), $perms->id) == 1) {
                                            echo " checked='checked'";
                                        }
                                        echo " />";
                                        echo $perms->title . "</label></div>";
                                    }
                                endforeach;
                                echo '</td>
                          </tr>';
                            endforeach;
                            ?>
                            <tr>
                                <td colspan="2"><input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/assign') ?>"  disabled1="disabled" class="button"/></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
