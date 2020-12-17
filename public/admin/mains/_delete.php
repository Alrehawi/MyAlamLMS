<?php require_once("../../../includes/initialize.php"); ?>
<?php

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MainCategoryDelete', '_manage.php');
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
        $main = MainCategory::find_by_id($checked_row[$i], " AND site_id={$session->site_id}");
        $user_admin = User::find_by_id($session->user_id);

        MainCategory::delete_translate_tree_by_parent($main->id, 1, NULL, MainCategory::$trans_key);

        // Delete MainCategory(s) and entries in other languages
        if ($main && $main->delete()) {
            $msg[] = ("{$main->title} " . read_xmls('/site/msg/wesdel'));
            echo log_action("Delete Main Category Item {$main->title} - id num : ({$main->id}) ", "By: {$user_admin->username} and all related translates");
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
}
?>
