<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('LogFileView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>

<?php
$logfile = SITE_ROOTDSO . DSO . 'logs' . DSO . 'log.txt';
if (isset($_GET['clear']) == 'true' && $session->check_permission('LogFileClear', '../')) {
    file_put_contents($logfile, "");
    log_action('Log Cleared', "By The User: {$session->user_id} ");
    redirect_to("./");
}
?>
<h2><?php echo read_xmls('/site/log/titles/logfile'); ?></h2><br><br>

<?php if ($session->has_permission('LogFileClear')) { ?>
<a href="../" class="btn btn-primary">&laquo; <?php echo read_xmls('/site/adminactions/back'); ?></a> <a href="?clear=true" class="btn btn-danger" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');"><?php echo read_xmls('/site/log/titles/clearlog'); ?></a>
<?php } ?>
<?php echo output_message($message); ?>
<?php
if (file_exists($logfile) && is_readable($logfile) && $handle = fopen($logfile, 'r')) { //read
    echo "<ul class=\"log-entries\">";
    while (!feof($handle)) {
        $entry = fgets($handle);
        if (trim($entry) != "") {
            echo "<li>{$entry}</li>";
        }
    }
    echo "</ul>";
} else {
    echo read_xmls('/site/log/msg/cntread') . " {$logfile}";
}
?>
<?php
// footer
include_layout_template('admin_footer.php');
?>
