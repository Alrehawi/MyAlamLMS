<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('ContactsView', '../');
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
$Action = new Contacts();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('ContactsDelete', '_manage.php')) {
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
$total_count = Contacts::count_all("WHERE " . Contacts::search(@$_GET['s'], array('name')) . " AND site_id={$session->site_id} ");
$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM contacts WHERE site_id={$session->site_id} ";
if (!empty($_GET['s'])) {
    $sql .= "WHERE " . Contacts::search(@$_GET['s'], array('name'))  . " AND site_id={$session->site_id} ";
}
$sql .= "ORDER BY id DESC ";
//$sql .= "LIMIT {$per_page} ";
//$sql .= "OFFSET {$pagination->offset()}";

$Contactss = Contacts::find_by_sql($sql);
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
            <h2><?php echo read_xmls('contactus_requests') ?> (<?php echo Contacts::count_all(  " WHERE site_id={$session->site_id} ") ?>)</h2>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                              <th><?php echo read_xmls('number') ?></th>
                              <th><?php echo read_xmls('name') ?></th>
                              <th><?php echo read_xmls('phone') ?></th>
                              <th><?php echo read_xmls('email') ?></th>
                              <th><?php echo read_xmls('date') ?></th>
                              <th><?php echo read_xmls('ip_address') ?></th>

                                <th class="no-sort" width="2%"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($Contactss as $Contacts):
                            ?>
                                <tr>
                                  <td><?php echo $Contacts->id ?></td>
                                  <td><a id='preview' href="<?php echo '_preview.php?id=' . $Contacts->id ?>"><?php echo $Contacts->name ?></a></td>
                                  <td><?php echo $Contacts->phone ?></td>
                                  <td><?php echo $Contacts->email ?></td>
                                  <td><?php echo $Contacts->created ?></td>
                                    <td><?php echo $Contacts->visitor_ip ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $Contacts->id; ?>" name="check[]" title="<?php echo $Contacts->name; ?>" <?php if ((is_array($checked_row) && in_array($Contacts->id, $checked_row)) || check_var("checked_row", "GET") == $Contacts->id) {
                                echo "checked='checked'";
                            } ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <span class="button-table" border="0" cellpadding="0" cellspacing="0">
                        <?php if ($session->has_permission('ContactsDelete')) { ?>
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
