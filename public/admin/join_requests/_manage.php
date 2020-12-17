<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('JoinRequestView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<script type="text/javascript">
    jQuery_1_3_2(document).ready(function () {
        jQuery_1_3_2("a#single").fancybox({
            'opacity': true,
            'overlayShow': true,
            'overlayColor': '#333',
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'titlePosition': 'over'
        });

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
$Action = new JoinRequest();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('JoinRequestDelete', '_manage.php')) {
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
$total_count = JoinRequest::count_all("WHERE " . JoinRequest::search(@$_GET['s'], array('full_name')) . " ");
$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM join_requests ";
if (!empty($_GET['s'])) {
    $sql .= "WHERE " . JoinRequest::search(@$_GET['s'], array('full_name')) . " ";
}
$sql .= "ORDER BY id ASC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$JoinRequests = JoinRequest::find_by_sql($sql);
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
            <h2><?php echo read_xmls('/site/join_requests/titles/manage') ?> (<?php echo JoinRequest::count_all() ?>)</h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                              <th><?php echo read_xmls('/site/join_requests/lables/full_name') ?></th>
                              <th><?php echo read_xmls('/site/join_requests/lables/photo') ?></th>
                              <th><?php echo read_xmls('/site/join_requests/lables/birth_date') ?></th>
                              <th><?php echo read_xmls('/site/join_requests/lables/nationality') ?></th>
                              <th><?php echo read_xmls('/site/join_requests/lables/stage_no') ?></th>
                              <th><?php echo read_xmls('/site/join_requests/lables/level_no') ?></th>
                              <th><?php echo read_xmls('/site/join_requests/lables/category_id') ?></th>
                              <th><?php echo read_xmls('/site/join_requests/lables/parent_mobile') ?></th>
                              <th><?php echo read_xmls('/site/join_requests/lables/parent_email') ?></th>
                                <th class="no-sort" width="2%"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($JoinRequests as $JoinRequest):
                            ?>
                                <tr>
                                  <td><a id='preview' href="<?php echo '_preview.php?id=' . $JoinRequest->id ?>"><?php echo $JoinRequest->full_name ?></a></td>
                                  <td><a  href="<?php echo Photographs::get_image($JoinRequest->photo, 'larg'); ?>"  id="single"><img src="<?php echo Photographs::get_image($JoinRequest->photo, 'small'); ?>" width="50"></a></td>
                                  <td><?php echo $JoinRequest->birth_date ?></td>
                                  <td><?php echo decode($JoinRequest->nationality,$nationality_array) ?></td>
                                  <td><?php echo decode($JoinRequest->stage_no,$stage_no_array) ?></td>
                                  <td><?php echo decode($JoinRequest->level_no,$level_no_array) ?></td>
                                  <td><?php echo decode($JoinRequest->category_id,$category_id_array) ?></td>
                                  <td><?php echo $JoinRequest->parent_mobile ?></td>
                                    <td><?php echo $JoinRequest->parent_email ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $JoinRequest->id; ?>" name="check[]" title="<?php echo $JoinRequest->full_name; ?>" <?php if ((is_array($checked_row) && in_array($JoinRequest->id, $checked_row)) || check_var("checked_row", "GET") == $JoinRequest->id) {
                                echo "checked='checked'";
                            } ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <span class="button-table" border="0" cellpadding="0" cellspacing="0">
                        <?php if ($session->has_permission('JoinRequestDelete')) { ?>
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
