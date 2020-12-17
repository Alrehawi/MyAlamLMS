<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
global $database, $session, $Subject, $content, $To, $msg, $direction;
$session->check_permission('MailView', '_manage.php');

$msg_id = @intval($_GET['message_id']);

if (!empty($msg_id) && MailMessage::count_by_field('id', $msg_id)) {
    echo "<h2>" . read_xmls('/site/mailmessage/lables/preview') . "</h2><br />";

    $msg_obj = MailMessage::find_by_id($msg_id);
    $Subject = SiteConfig::site_config('title') . ' :: ' . $msg_obj->subject;
    $content = $msg_obj->content;
    $direction = $msg_obj->direction;
    echo include_layout_template('email_templates/mail_template.php');
    $MailMsg = $msg;
    echo $MailMsg;
} else {
    echo "<h2>" . read_xmls('/site/mailmessage/validation/cantfindmessage') . "</h2><br />";
}
?>

<br />
