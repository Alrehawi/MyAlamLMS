<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SubscriptionView', '../');
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
$Action = new Subscription();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('SubscriptionDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}
?>

<?php
echo output_message($message);
// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = Subscription::count_all("WHERE " . Subscription::search(@$_GET['s'], array('full_name')) . " ");
$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM subscription ";
if (!empty($_GET['s'])) {
    $sql .= "WHERE " . Subscription::search(@$_GET['s'], array('full_name')) . " ";
}
$sql .= "ORDER BY id ASC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$Subscriptions = Subscription::find_by_sql($sql);
?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/subscription/titles/manage') ?> (<?php echo Subscription::count_all() ?>)</h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/subscription/lables/name') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($Subscriptions as $Subscription):?>
                                <tr>
                                    <td><a id='preview' href="<?php echo '_preview.php?id=' . $Subscription->id ?>"><?php echo $Subscription->full_name ?></a></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $Subscription->id; ?>" name="check[]" title="<?php echo $Subscription->full_name; ?>" <?php if ((is_array($checked_row) && in_array($Subscription->id, $checked_row)) || check_var("checked_row", "GET") == $Subscription->id) {
                                        echo "checked='checked'";
                                         } ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <span class="button-table">
                                <?php if ($session->has_permission('SubscriptionEdit')) { ?>
                                <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                <?php } ?>
                                <?php if ($session->has_permission('SubscriptionDelete')) { ?>
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
