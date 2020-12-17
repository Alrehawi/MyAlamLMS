<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('LogFileClear', './');
if(!checkToken($_POST['_token'])){
  $session->message(read_xmls('/site/msg/invalidsubmit'));
  redirect_to("./");
}

if (!isset($checked_row)) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("./");
}
if (!is_array($checked_row)) {
    $session->message(read_xmls('/site/msg/notvalid'));
} else {
    $count_array = count($checked_row);
    for ($i = 0; $i < $count_array; $i++) {
        if (empty($checked_row[$i])) {
            $msg[] = (read_xmls('/site/msg/noid') . "<br />");
        }
        $activitylog = ActivityLog::find_by_id($checked_row[$i]);
        $user_admin = User::find_by_id($session->user_id);

        if ($activitylog && $activitylog->delete()) {
            $msg[] = ("{$activitylog->full_name} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete ActivityLog {$activitylog->full_name} - id num : ({$activitylog->id}) ", "By: {$user_admin->username}");
        } else {
            $msg[] = (read_xmls('/site/msg/cantdel') . "<br />");
        }
    }
    $session->message(join("<br/>", $msg));
    redirect_to("./");
}
?>
<?php

if (isset($database)) {
    $database->close_connection();
}?>
