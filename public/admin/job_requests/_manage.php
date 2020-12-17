<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('JobRequestView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<script type="text/javascript">
    jQuery_1_3_2(document).ready(function () {
        jQuery_1_3_2("a#preview").fancybox({
            'width': '75%',
            'height': '75%',
            'autoScale': true,
            'type': 'iframe',
            'opacity': true,
            'overlayShow': true,
            'overlayColor': '#333',
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'titlePosition': 'over'
        });
    });
</script>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new JobRequest();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('JobRequestDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}
?>

<?php
// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = JobRequest::count_all("WHERE " . JobRequest::search(@$_GET['s'], array('full_name')) . " ");
$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM job_requests ";
if (!empty($_GET['s'])) {
    $sql .= "WHERE " . JobRequest::search(@$_GET['s'], array('full_name')) . " ";
}
$sql .= "ORDER BY id ASC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$JobRequests = JobRequest::find_by_sql($sql);
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
             <h2><?php echo read_xmls('/site/jobrequest/titles/manage') ?> </h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                              <th><?php echo read_xmls('/site/jobrequest/lables/full_name') ?></th>
                              <th><?php echo read_xmls('/site/jobrequest/lables/file_id') ?></th>
                              <th><?php echo read_xmls('/site/jobrequest/lables/mobile') ?></th>
                              <th><?php echo read_xmls('/site/jobrequest/lables/email') ?></th>
                              <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($JobRequests as $JobRequest):
                                    ?>
                                <tr>
                                  <td><a id='preview' href="<?php echo '_preview.php?id=' . $JobRequest->id ?>"><?php echo $JobRequest->full_name ?></a></td>
                                  <td><a  href="<?php echo File::get_file($JobRequest->file_id); ?>"  target="_blank"><?php echo show_icon('file.png',read_xmls('/site/jobrequest/lables/file_id')); ?></a></td>
                                  <td><?php echo $JobRequest->mobile ?></td>
                                   <td><?php echo $JobRequest->email ?></td>
                                   <td align="center"><input type="checkbox" value="<?php echo $JobRequest->id; ?>" name="check[]" title="<?php echo $JobRequest->full_name; ?>" <?php if ((is_array($checked_row) && in_array($JobRequest->id, $checked_row)) || check_var("checked_row", "GET") == $JobRequest->id) {
                                          echo "checked='checked'";
                                       } ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <span class="button-table">
                        <?php if ($session->has_permission('JobRequestDelete')) { ?>
                            <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                            <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                       <?php } ?>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
