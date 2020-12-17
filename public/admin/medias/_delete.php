<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MediaDelete', '_manage.php');
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
        $media = Media::find_by_id($checked_row[$i]);
        $user_admin = User::find_by_id($session->user_id);

        if ($media->media_type == 'youtube' && $media->delete()) {
            //deleting video
            $msg[] = ("{$media->title} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete Youtube {$media->title} - id num : ({$media->id}) ", "By: {$user_admin->username} and all related translates");
        } else if ($media->media_type == 'video' || $media->media_type == 'audio') {
            $file_ins = File::find_by_id($media->file_id);
            if($file_ins->destroy()) {
                $msg[] = ("{$media->title} " . read_xmls('/site/msg/wesdel'));
                echo log_action("Delete Media {$media->title} - id num : ({$media->id}) ", "By: {$user_admin->username} and all related translates");
            }
        } else if ($media->media_type == 'image' && $media->destroy()) {
            // Delete Media(s) and entries in other languages
            $delete_translates = Translator::delete_by_parent($media->id, Media::$trans_key);
            $msg[] = ("{$media->title} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete Media {$media->title} - id num : ({$media->id}) ", "By: {$user_admin->username} and all related translates");
        } else {
            $msg[] = (read_xmls('/site/msg/cantdel') . "<br />");
        }
    }
    $session->message(join("<br/>", $msg));
    redirect_to("_manage.php?gallery_id=".$media->gallery_id);
}
?>
<?php

if (isset($database)) {
    $database->close_connection();
}?>
