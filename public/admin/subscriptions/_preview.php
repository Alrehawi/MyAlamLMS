<?php
require_once('../../../includes/initialize.php');
echo get_css('admin_style.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
global $database, $session, $Subject, $content, $To, $msg, $direction;
$session->check_permission('SubscriptionView', '_manage.php');

$subs_id = @intval($_GET['id']);

if (!empty($subs_id) && Subscription::count_by_field('id', $subs_id)) {
    $subscripe = Subscription::find_by_id($subs_id);
    echo "<br /><br /><h2>" . read_xmls('/site/subscription/lables/name') . ": " . $subscripe->full_name . "</h2><br />";
    ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/subscription/lables/fullname') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $subscripe->full_name ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/subscription/lables/gender') ?></td>
            <td width="80%" height="30">
                <?php
                if ($subscripe->gender == 1) {
                    echo read_xmls('/site/subscription/lables/male');
                } else if ($subscripe->gender == 2) {
                    echo read_xmls('/site/subscription/lables/female');
                }
                ?>
            </td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/subscription/lables/birthdate') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $subscripe->birth_date ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/subscription/lables/profession') ?></td>
            <td width="80%" height="30"><?php echo $subscripe->profession ?></td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/subscription/lables/nationality') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $subscripe->nationality ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/subscription/lables/tel') ?></td>
            <td width="80%" height="30"><?php echo $subscripe->tel ?></td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/subscription/lables/mobile') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $subscripe->mobile ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/subscription/lables/email') ?></td>
            <td width="80%" height="30"><?php echo $subscripe->email ?></td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/subscription/lables/country') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $subscripe->country ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/subscription/lables/interests') ?></td>
            <td width="80%" height="30"><?php echo nl2br($subscripe->interests) ?></td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/adminactions/created') ?></td>
            <td width="80%" height="30" bgcolor="#eee"  bgcolor="#eee"><?php echo $subscripe->created ?></td>
        </tr>
    </table><br />
    <br />
    <?php
} else {
    echo "<h2>" . read_xmls('/site/msg/cantfindresults') . "</h2><br />";
}
?>
<br />
