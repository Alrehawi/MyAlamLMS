<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('LanguageDelete__STOPPED', '_manage.php');
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
        $lang = Language::find_by_id($checked_row[$i]);
        $user_admin = User::find_by_id($session->user_id);
        // if (delete_file(".." . DS . ".." . DS . "xml" . DS . $lang->xml_path)) {
        //     $msg[] = ($lang->xml_path . ": " . read_xmls('/site/msg/filedeleted') . "<br />");
        // } else {
        //     $msg[] = ($lang->xml_path . ": " . read_xmls('/site/msg/filenotfound') . "<br />");
        // }
        // if (delete_file(".." . DS . ".." . DS . "stylesheets" . DS . $lang->css_path)) {
        //     $msg[] = ($lang->css_path . ": " . read_xmls('/site/msg/filedeleted') . "<br />");
        // } else {
        //     $msg[] = ($lang->css_path . ": " . read_xmls('/site/msg/filenotfound') . "<br />");
        // }
        // Delete lang(s) and related translates
        if ($lang && $lang->delete()) {
            // Delete Related Translates
            $delete_translates = Translator::delete_by_lang($lang->id);

            $msg[] = ("{$lang->title} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete Language {$lang->title} - id num : ({$lang->id}) ", "By: {$user_admin->username} and all related translates and files");
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
