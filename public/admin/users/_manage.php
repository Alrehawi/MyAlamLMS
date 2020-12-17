<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('UserView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new User();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('UserEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('UserDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('UserPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('UserPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

$user = User::find_by_id($session->user_id);
if ($user->role_id == 7) {
    $cond = "";
} else {
    $cond = " AND role_id != 7 AND site_id={$session->site_id} ";
}
$cond2 = " AND (" . User::search(@$_GET['s'], array('username', 'email')) . ") ";
// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;

$sql = "SELECT  u.*,a.site_id FROM roles a, users u WHERE a.id = u.role_id " . $cond .$cond2;
$total_count = User::count_by_sql_stat($sql);

$pagination = new Pagination($page, $per_page, $total_count);

if (!empty($_GET['s'])) {
    $sql .= $cond2;
}
$sql .= "ORDER BY created DESC LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$users = User::find_by_sql($sql);
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
                <h2><?php echo read_xmls('/site/users/titles/manage') ?></h2>
                <?php if ($session->has_permission('UserAdd')) { ?>
                        <a style="color: #fff;"  class="pull-left btn btn-primary" href="_add.php"><?php echo read_xmls('/site/users/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr>
                                <th><?php echo read_xmls('/site/users/lables/username') ?></th>
                                <th><?php echo read_xmls('/site/users/lables/email') ?></th>
                                <th><?php echo read_xmls('/site/roles/lables/name') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($users as $user):?>
                                <tr>
                                    <td><?php echo $user->username; ?></td>
                                    <td align="center"><?php echo $user->email; ?></td>
                                    <td align="center"><?php
                                    $get_role = Role::find_by_id($user->role_id);
                                    echo $get_role->title;
                                    ?></td>
                                    <td align="center"><?php echo show_published($user->publish); ?></td>
                                    <td align="center">
                                        <input type="checkbox" value="<?php echo $user->id; ?>" name="check[]" title="<?php echo $user->username; ?>" <?php if ((is_array($checked_row) && in_array($user->id, $checked_row)) || check_var("checked_row", "GET") == $user->id) {
                                            echo "checked='checked'";
                                             } ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <table class="button-table" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <?php if ($session->has_permission('UserPublish')) { ?>
                                    <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                    <input class="btn btn-success" name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish" class="button" />
                                <?php } ?>
                                <?php if ($session->has_permission('UserPublish')) { ?>
                                    <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                    <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('UserEdit')) { ?>
                                    <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                    <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('UserDelete')) { ?>
                                    <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                    <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                                    <?php } ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
