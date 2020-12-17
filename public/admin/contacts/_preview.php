<?php
require_once('../../../includes/initialize.php');
echo get_css('admin_style.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
global $database, $session, $Subject, $content, $To, $msg, $direction;
$session->check_permission('ContactsView', '_manage.php');

$subs_id = @intval($_GET['id']);

if (!empty($subs_id) && Contacts::count_by_field('id', $subs_id)) {
    $Contacts = Contacts::find_by_id($subs_id);
    echo "<br /><br /><h2>" . read_xmls('request_of') . ": " . $Contacts->name . "</h2><br />";
    ?>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('number') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $Contacts->id ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('name') ?></td>
            <td width="80%" height="30"><?php echo $Contacts->name ?></td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('phone') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $Contacts->phone ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('email') ?></td>
            <td width="80%" height="30"><?php echo $Contacts->email ?></td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('message') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo nl2br($Contacts->msg); ?></td>
        </tr>

        <tr>
            <td width="20%" height="30"><?php echo read_xmls('date') ?></td>
            <td width="80%" height="30" ><?php echo $Contacts->created ?></td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('ip_address') ?></td>
            <td width="80%" height="30" bgcolor="#eee"  ><?php echo $Contacts->visitor_ip ?></td>
        </tr>
    </table><br />
    <br />
    <?php
} else {
    echo "<h2>" . read_xmls('/site/msg/cantfindresults') . "</h2><br />";
}
?>
<br />
