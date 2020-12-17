<?php

require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('GalleryTranslate', '_manage.php');
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
        $translates = Translator::find_by_id($checked_row[$i]);
        $user_admin = User::find_by_id($session->user_id);

        // Delete Gallery(s) and entries in other languages

        if (Translator::delete_by_parent_lang_type($translates->parent_id, $translates->lang_id, $translates->item_type)) {
            $msg[] = ("{$translates->content} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete Translate Of {$translates->content} - id num : ({$translates->id}) ", "By: {$user_admin->username}");
        } else {
            $msg[] = (read_xmls('/site/msg/cantdel') . "<br />");
        }
    }
    $session->message(join("<br/>", $msg));
    redirect_to("_translate.php?parent={$translates->parent_id}");
}
?>
<?php

if (isset($database)) {
    $database->close_connection();
}?>
