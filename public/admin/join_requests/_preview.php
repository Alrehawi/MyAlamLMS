<?php
require_once('../../../includes/initialize.php');
echo get_css('admin_style.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
global $database, $session, $Subject, $content, $To, $msg, $direction;
$session->check_permission('JoinRequestView', '_manage.php');

$subs_id = @intval($_GET['id']);

if (!empty($subs_id) && JoinRequest::count_by_field('id', $subs_id)) {
    $JoinRequest = JoinRequest::find_by_id($subs_id);
    echo "<br /><br /><h2>" . read_xmls('/site/join_requests/lables/name') . ": " . $JoinRequest->full_name . "</h2><br />";
    ?>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/join_requests/lables/full_name') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $JoinRequest->full_name ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/join_requests/lables/gender') ?></td>
            <td width="80%" height="30">
              <?php echo decode($JoinRequest->gender,$gender_array) ?>
            </td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/join_requests/lables/birth_date') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $JoinRequest->birth_date ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/join_requests/lables/nationality') ?></td>
            <td width="80%" height="30">
              <?php echo decode($JoinRequest->nationality,$nationality_array) ?>
            </td>
        </tr>

        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/join_requests/lables/mobile') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $JoinRequest->mobile ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/join_requests/lables/email') ?></td>
            <td width="80%" height="30">
              <?php echo $JoinRequest->email ?>
            </td>
        </tr>

        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/join_requests/lables/id_no') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $JoinRequest->id_no ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/join_requests/lables/address') ?></td>
            <td width="80%" height="30">
              <?php echo nl2br($JoinRequest->address) ?>
            </td>
        </tr>

        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/join_requests/lables/photo') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><a target="_blank" href="<?php echo Photographs::get_image($JoinRequest->photo, 'larg'); ?>"  id="single"><img src="<?php echo Photographs::get_image($JoinRequest->photo, 'small'); ?>" width="50"></a></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/join_requests/lables/stage_no') ?></td>
            <td width="80%" height="30">
              <?php echo decode($JoinRequest->stage_no,$stage_no_array) ?>
            </td>
        </tr>

        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/join_requests/lables/level_no') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo decode($JoinRequest->level_no,$level_no_array) ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/join_requests/lables/category_id') ?></td>
            <td width="80%" height="30">
              <?php echo decode($JoinRequest->category_id,$category_id_array) ?>
            </td>
        </tr>

        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/join_requests/lables/parent_full_name') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $JoinRequest->parent_full_name ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/join_requests/lables/parent_id_no') ?></td>
            <td width="80%" height="30">
              <?php echo $JoinRequest->parent_id_no?>
            </td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/join_requests/lables/parent_mobile') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $JoinRequest->parent_mobile ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/join_requests/lables/parent_email') ?></td>
            <td width="80%" height="30">
              <?php echo $JoinRequest->parent_email?>
            </td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/adminactions/created') ?></td>
            <td width="80%" height="30" bgcolor="#eee"  bgcolor="#eee"><?php echo $JoinRequest->created ?></td>
        </tr>
    </table><br />
    <br />
    <?php
} else {
    echo "<h2>" . read_xmls('/site/msg/cantfindresults') . "</h2><br />";
}
?>
<br />
