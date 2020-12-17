<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('JobRequestDelete', '_manage.php');
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
        if (empty($checked_row[$i])) {
            $msg[] = (read_xmls('/site/msg/noid') . "<br />");
        }
        $jobrequest = JobRequest::find_by_id($checked_row[$i]);
        $user_admin = User::find_by_id($session->user_id);
        //remove photo
        if (!empty($jobrequest->file_id) && File::check_file_exist($jobrequest->file_id)) {
            @$file = File::find_by_id($jobrequest->file_id);
            @$file->destroy();
        }
        // Delete JobRequest(s) other languages
        if ($jobrequest && $jobrequest->delete()) {
            $msg[] = ("{$jobrequest->full_name} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete JobRequest {$jobrequest->full_name} - id num : ({$jobrequest->id}) ", "By: {$user_admin->username}");
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
