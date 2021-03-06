<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SubjectDelete', '_manage.php');
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
        $subject = Subject::find_by_id($checked_row[$i]);
        $user_admin = User::find_by_id($session->user_id);
        //remove photo
        if (!empty($subject->photo) && Photographs::check_file_exist($subject->photo)) {
            @$photo = Photographs::find_by_id($subject->photo);
            @$photo->destroy();
        }
        // Delete Subject(s) and entries in other languages
        if ($subject && $subject->delete()) {
            $delete_translates = Translator::delete_by_parent($subject->id, Subject::$trans_key);
            $msg[] = ("{$subject->title} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete Subject {$subject->title} - id num : ({$subject->id}) ", "By: {$user_admin->username} and all related translates");
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
