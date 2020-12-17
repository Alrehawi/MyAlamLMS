<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('RoleDelete', '_manage.php');
if(!checkToken($_POST['_token'])){
  $session->message(read_xmls('/site/msg/invalidsubmit'));
  redirect_to("_manage.php");
}


if (!isset($checked_row)) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
if (!is_array($checked_row)) {
    $session->message(read_xmls('/site/msg/notvalid'));
} else {
    $count_array = count($checked_row);
    for ($i = 0; $i < $count_array; $i++) {
        //echo $checked_row[$i]."<br />";
        if (empty($checked_row[$i])) {
            $msg[] = (read_xmls('/site/msg/noid') . "<br />");
        }

        $user_admin = User::find_by_id($session->user_id);
        //Drop Perms before removing roles
        $role = Role::find_by_id($checked_row[$i]," AND site_id={$session->site_id}");
        //echo Per2role::drop_perms($role->id);
        // Delete Role(s)
        if ($role && $role->delete()) {
            $msg[] = ("{$role->title} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete Role {$role->title} - id num : ({$role->id}) ", "By: {$user_admin->username}");
        } else {
            $msg[] = (read_xmls('/site/msg/cantdel') . "<br />");
        }
    }
    $session->message(join("<br/>", $msg));
    redirect_to("_manage.php");
}
?>
<?php

if (isset($database)) {
    $database->close_connection();
}?>
