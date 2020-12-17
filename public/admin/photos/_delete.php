<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PhotoDelete', '_manage.php?photo_sec=admin');
if(!checkToken($_POST['_token'])){
  $session->message(read_xmls('/site/msg/invalidsubmit'));
  redirect_to("_manage.php");
}

if (!isset($checked_row)) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php?photo_sec=admin");
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
        $photo = Photographs::find_by_id($checked_row[$i]," AND site_id={$session->site_id}");

        $user = User::find_by_id($session->user_id);
        if ($photo && $photo->destroy()) {
            $msg[] = "{$photo->caption} " . read_xmls('/site/msg/wesdel');
            echo log_action("Delete Photo {$photo->caption}id num : ({$photo->id})", "By: {$user->username}");
        } else {
            $msg[] = (read_xmls('/site/msg/cantdel') . "<br />");
        }
    }
    $session->message(join("<br/>", $msg));
    redirect_to("_manage.php?photo_sec=admin");
}
?>
<?php

if (isset($database)) {
    $database->close_connection();
}?>
