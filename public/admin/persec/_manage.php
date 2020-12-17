<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PerSecView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new PerSec();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('PerSecEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}
// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('PerSecDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

if (!empty($_GET['s'])) {
    $persecs = PerSec::find_all('title ASC', "WHERE " . PerSec::search(@$_GET['s'], array('title')) . " ");
} else {
    $persecs = PerSec::find_all('title ASC');
}
?>
<?php echo output_message($message); ?>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/persecs/titles/manage') ?></h2>
                <a class="btn btn-primary pull-left"  href="_add.php"><?php echo read_xmls('/site/persecs/titles/add') ?>
                    <i class="fa fa-plus margin-right-fivePx"></i>
                </a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr >
                                <th><?php echo read_xmls('/site/persecs/lables/name') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                foreach ($persecs as $persec):
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo get_relative_link(ADMIN . DS . 'permissions' . DS . '_manage.php#' . $persec->id) ?>"><?php echo $persec->title; ?></a></td>
                                        <td align="center"><input type="checkbox" value="<?php echo $persec->id; ?>" name="check[]" title="<?php echo $persec->title; ?>" <?php if ((is_array($checked_row) && in_array($persec->id, $checked_row)) || check_var("checked_row", "GET") == $persec->id) {
                                        echo "checked='checked'";
                                    } ?>/></td>
                                    </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <span class="button-table pull-right">
                       <div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                            <?php if ($session->has_permission('PerSecEdit')) { ?>
                                 <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                  <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="button" />
                            <?php } ?>
                            <?php if ($session->has_permission('PerSecDelete')) { ?>
                                <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                            <?php } ?>

                        </div>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include_layout_template('admin_footer.php'); ?>
