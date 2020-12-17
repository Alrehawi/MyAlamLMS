<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('RoleView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Role();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('RoleEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Assign Role Permission
if (check_var("assign", "POST") && check_var("check", "POST") && $session->check_permission('RoleAssign', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '../assigns/per2role_assign.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('RoleDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

$user = User::find_by_id($session->user_id);
if ($user->role_id == 7) {
    $cond = "";
    $cond2 = " WHERE " . Role::search(@$_GET['s'], array('title')) . " ";
} else {
    $cond = " WHERE id <>7 AND site_id={$session->site_id} ";
    $cond2 = " AND " . Role::search(@$_GET['s'], array('title')) . " ";
}
// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = Role::count_all($cond . $cond2);

$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM roles " . $cond;
if (!empty($_GET['s'])) {
    $sql .= $cond2;
}
$sql .= " LIMIT {$per_page} ";
$sql .= " OFFSET {$pagination->offset()}";

$roles = Role::find_by_sql($sql);
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
                <h2><?php echo read_xmls('/site/roles/titles/manage') ?></h2>
                <?php if ($session->has_permission('RoleAdd')) { ?>
                    <a style="color: #fff;"  class="pull-left btn btn-primary"  href="_add.php"><?php echo read_xmls('/site/roles/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/roles/lables/name') ?></th>
                                <th width='20%'><?php echo read_xmls('/site/roles/lables/site') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $role):?>
                                <tr>
                                    <td><?php echo $role->title; ?></td>
                                    <td align="center"><?php echo SiteConfig::find_viewed_language('title', $role->site_id, SiteConfig::$trans_key) ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $role->id; ?>" name="check[]" title="<?php echo $role->title; ?>" <?php
                                        if (in_array($role->id, $checked_row)) {
                                            echo "checked='checked'";
                                        }
                                        ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="button-table"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('RoleAssign')) { ?>
                                        <input class="btn btn-info" name="assign" type="submit" value="<?php echo read_xmls('/site/per2rol/titles/assign') ?>" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('RoleEdit')) { ?>
                                        <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('RoleDelete')) { ?>
                                        <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                        <input class="btn btn-danger" name="dell" id='delete' type="submit" onClick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>" class="button">
                                    <?php } ?>
                                </div></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
