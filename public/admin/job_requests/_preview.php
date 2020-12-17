<?php
require_once('../../../includes/initialize.php');
echo get_css('admin_style.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
global $database, $session, $Subject, $content, $To, $msg, $direction;
$session->check_permission('JobRequestView', '_manage.php');

$subs_id = @intval($_GET['id']);

if (!empty($subs_id) && JobRequest::count_by_field('id', $subs_id)) {
    $JobRequest = JobRequest::find_by_id($subs_id);
    echo "<br /><br /><h2>" . read_xmls('/site/jobrequest/lables/name') . ": " . $JobRequest->full_name . "</h2><br />";
    ?>

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/jobrequest/lables/full_name') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $JobRequest->full_name ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/jobrequest/lables/gender') ?></td>
            <td width="80%" height="30">
              <?php echo decode($JobRequest->gender,$gender_array) ?>
            </td>
        </tr>
        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/jobrequest/lables/mobile') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><?php echo $JobRequest->mobile ?></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/jobrequest/lables/email') ?></td>
            <td width="80%" height="30">
              <?php echo $JobRequest->email ?>
            </td>
        </tr>

        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/jobrequest/lables/file_id') ?></td>
            <td width="80%" height="30" bgcolor="#eee"><a  href="<?php echo File::get_file($JobRequest->file_id); ?>"  target="_blank"><?php echo show_icon('file.png',read_xmls('/site/jobrequest/lables/file_id')); ?></a></td>
        </tr>
        <tr>
            <td width="20%" height="30"><?php echo read_xmls('/site/jobrequest/lables/notes') ?></td>
            <td width="80%" height="30">
              <?php echo nl2br($JobRequest->notes) ?>
            </td>
        </tr>


        <tr>
            <td width="20%" height="30" bgcolor="#eee"><?php echo read_xmls('/site/adminactions/created') ?></td>
            <td width="80%" height="30" bgcolor="#eee"  bgcolor="#eee"><?php echo $JobRequest->created ?></td>
        </tr>
    </table><br />
    <br />
    <?php
} else {
    echo "<h2>" . read_xmls('/site/msg/cantfindresults') . "</h2><br />";
}
?>
<br />
