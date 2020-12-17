<?php
global $session;
require_once("../../includes/initialize.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['email']) && $_POST['email'] != read_xmls('/site/frontend/newsletter/enteremail')) {
    $default_newsletter = MailGroup::find_all("id DESC LIMIT 1", "WHERE newsletter=1 AND site_id={$session->site_id} ");

    @$mails = new Mail();
    @$mails->email = trim($_POST['email']);
    @$mails->mobile = trim($_POST['mobile']);
    @$mails->mail_groups_id = $default_newsletter[0]->id;
    @$mails->publish = 0;
    @$mails->created = current_date();

    if ($mails->save_mail()) {
        echo "<span class='green'>" . read_xmls('/site/msg/sucuadd') . "</span>";
        //echo log_action("Add New Mail: {$mails->email} " , "By: Visitor");
    } else {
        echo "<span class='red'>" . join("<br/>", $mails->errors) . "</span>";
    }
} else {
    echo "<span class='red'>" . read_xmls('/site/msg/allrequire') . "</span>";
}
?>