<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PermissionView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Permission();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('PermissionEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}
// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('PermissionDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/perms/titles/manage') ?></h2>
                 <?php if ($session->has_permission('PermissionAdd')) { ?>
                    <a class=" btn btn-primary pull-left margin-link" href="_add.php"><?php echo read_xmls('/site/perms/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
                <?php if ($session->has_permission('PerSecView')) { ?>
                    <a class=" btn btn-primary pull-left margin-link" href="<?php echo get_relative_link(ADMIN . DS . 'persec' . DS . '_manage.php') ?>"><?php echo read_xmls('/site/persecs/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>
                <?php } ?>
                <?php if ($session->has_permission('PerSecAdd')) { ?>
                    <a class=" btn btn-primary pull-left margin-link" href="<?php echo get_relative_link(ADMIN . DS . 'persec' . DS . '_add.php') ?>"><?php echo read_xmls('/site/persecs/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr >
                                <th class="no-sort"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" />
                                <?php echo read_xmls('/site/perms/lables/name') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                            if (!empty($_GET['s'])) {
                                $persecs = PerSec::find_all('title ASC', "WHERE " . PerSec::search(@$_GET['s'], array('title')) . " ");
                            } else {
                                $persecs = PerSec::find_all('title ASC');
                            }
                            foreach ($persecs as $persec):
                                echo "<tr>
                            <td>
                            <h3><a name='{$persec->id}'></a>{$persec->title}: </h3>";
                                $sql = "SELECT * FROM permissions WHERE persec_id=" . $database->escape_value($persec->id) . " ORDER BY title ASC";
                                $pers = Permission::find_by_sql($sql);
                                foreach ($pers as $per):
                                    ?>
                                    <div class="form-group permissions">
                                        <input type="checkbox" value="<?php echo $per->id; ?>" name="check[]" title="<?php echo $per->title; ?>"
                                        <?php
                                        if ((is_array($checked_row) && in_array($per->id, $checked_row)) || check_var("checked_row", "GET") == $per->id) {
                                            echo "checked='checked'";
                                        }
                                        ?>/><?php echo $per->title; ?><br><i class="small"><?php echo limit_text($per->page_path,30); ?></i>
                                    </div>
                                <?php endforeach; ?>
                                <?php
                                echo '</td>
                          </tr>';
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <span class="button-table">
                           <?php if ($session->has_permission('PermissionEdit')) { ?>
                                 <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            <?php } ?>
                            <?php if ($session->has_permission('PermissionDelete')) { ?>
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
