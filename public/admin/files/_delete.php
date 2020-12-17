<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('FileDelete', '_manage.php');
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
        $file = File::find_by_id($checked_row[$i]," AND site_id={$session->site_id}");
        $user_admin = User::find_by_id($session->user_id);

        // Delete File(s) other languages
        if ($file && $file->destroy()) {
            $delete_translates = Translator::delete_by_parent($file->id, File::$trans_key);
            $msg[] = ("{$file->title} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete File {$file->title} - id num : ({$file->id}) ", "By: {$user_admin->username}");
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
