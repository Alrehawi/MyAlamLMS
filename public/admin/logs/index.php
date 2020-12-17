<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('LogFileView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new ActivityLog();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('LogFileClear', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

if (isset($_GET['clear']) == 'true' && $session->check_permission('LogFileClear', '../')) {
    if(ActivityLog::delete_all(" where site_id={$session->site_id}")){
    log_action('Log Cleared', "By The User: {$session->user_id} ");
    $session->message(read_xmls('all_records_deleted_successfully'));
  } else {
    $session->message(read_xmls('fail_in_deleting_process'));
  }
  redirect_to("./");
}

// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = ActivityLog::count_all("WHERE " . ActivityLog::search(@$_GET['s'], array('path','action','msg')) . " AND site_id={$session->site_id} ");
$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM activity_log WHERE site_id={$session->site_id} ";
if (!empty($_GET['s'])) {
    $sql .= "WHERE  " . ActivityLog::search(@$_GET['s'], array('path')) . " AND site_id={$session->site_id} ";
}
$sql .= "ORDER BY id DESC ";
//$sql .= "LIMIT {$per_page} ";
//$sql .= "OFFSET {$pagination->offset()}";

$ActivityLogs = ActivityLog::find_by_sql($sql);
?>
  <!-- message -->
<div class="row">
    <div class="col-lg-12">
        <?php echo output_message($message); ?>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h2><?php echo read_xmls('activity_logs') ?> (<?php echo ActivityLog::count_all( " WHERE site_id={$session->site_id} ") ?>)</h2>
            <?php if ($session->has_permission('LogFileClear')) { ?>
             <a href="?clear=true" class="pull-left  btn btn-danger" onclick="return confirmation('<?php echo read_xmls('delete_all_logs') ?>?');"><?php echo read_xmls('delete_all_logs'); ?></a>
            <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                              <th><?php echo read_xmls('number') ?></th>
                              <th><?php echo read_xmls('path') ?></th>
                              <th><?php echo read_xmls('actions') ?></th>
                              <th><?php echo read_xmls('message') ?></th>
                              <th><?php echo read_xmls('date') ?></th>
                              <th><?php echo read_xmls('ip_number') ?></th>
                              <th class="no-sort" width="2%"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($ActivityLogs as $ActivityLog):
                            ?>
                                <tr>
                                  <td><?php echo $ActivityLog->id ?></td>
                                  <td dir="ltr"><?php echo limit_text($ActivityLog->path,60) ?></td>
                                  <td><?php echo addslashes($ActivityLog->action) ?></td>
                                  <td><?php echo $ActivityLog->msg ?></td>
                                  <td><?php echo $ActivityLog->created ?></td>
                                  <td><?php echo $ActivityLog->ip_address ?></td>
                                  <td align="center"><input type="checkbox" value="<?php echo $ActivityLog->id; ?>" name="check[]" title="" <?php if ((is_array($checked_row) && in_array($ActivityLog->id, $checked_row)) || check_var("checked_row", "GET") == $ActivityLog->id) {
                                echo "checked='checked'";
                            } ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                     <table class="button-table" border="0" cellpadding="0" cellspacing="0">
                      <tr><td>
                        <div align="<?php echo read_xmls('_site_config_otheralign');?>">
                        <?php if ($session->has_permission('LogFileClear')) { ?>
                         <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                        <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                        <?php } ?>
                      </div>
                      </td></tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
