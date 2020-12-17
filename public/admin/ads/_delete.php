<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('AdDelete', '_manage.php');
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
        $ad = Ad::find_by_id($checked_row[$i]);
        $user_admin = User::find_by_id($session->user_id);
        //remove photo
        if ($ad->ad_type == 'flash') {
            if (!empty($ad->photo) && File::check_file_exist($ad->photo)) {
                @$file = File::find_by_id($ad->photo);
                @$file->destroy();
            }
        } else {
            if (!empty($ad->photo) && Photographs::check_file_exist($ad->photo)) {
                @$photo = Photographs::find_by_id($ad->photo);
                @$photo->destroy();
            }
        }
        // Delete Ad(s) and entries in other languages
        if ($ad && $ad->delete()) {
            $delete_translates = Translator::delete_by_parent($ad->id, Ad::$trans_key);
            $msg[] = ("{$ad->title} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete Ad {$ad->title} - id num : ({$ad->id}) ", "By: {$user_admin->username} and all related translates");
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
