<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailGroupView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new MailGroup();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('MailGroupEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('MailGroupTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('MailGroupDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('MailGroupPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('MailGroupPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Make as NewsLetter
if (check_var("newsletter", "POST") && check_var("check", "POST") && $session->check_permission('MailGroupsNewsLetter', '_manage.php')) {
    return $Action->do_action('defaults', $_POST['check'], get_current_page(), FALSE, " WHERE site_id={$session->site_id} ", 'newsletter');
}
?>

<?php
// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = MailGroup::count_all("WHERE site_id={$session->site_id} and " . MailGroup::search(@$_GET['s'], array('title')) . " ");
$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM mail_groups WHERE site_id={$session->site_id} ";
if (!empty($_GET['s'])) {
    $sql .= " AND " . MailGroup::search(@$_GET['s'], array('title')) . " ";
}
$sql .= " ORDER BY title ASC ";
$sql .= " LIMIT {$per_page} ";
$sql .= " OFFSET {$pagination->offset()}";

$MailGroups = MailGroup::find_by_sql($sql);
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
                <h2><?php echo read_xmls('/site/mailgroup/titles/manage') ?></h2>
                <?php if ($session->has_permission('MailGroupAdd')) { ?>
                    <a class="pull-left btn btn-primary" href="_add.php"><?php echo read_xmls('/site/mailgroup/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/mailgroup/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/mailgroup/lables/newsletter') ?></th>
                                <th><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($MailGroups as $MailGroup):
                                ?>
                                <tr>
                                    <td><a href="<?php echo get_relative_link(ADMIN . DS . 'mails' . DS . '_manage.php?mail_groups_id=' . $MailGroup->id) ?>"><?php echo MailGroup::find_viewed_language('title', intval($MailGroup->id), MailGroup::$trans_key) ?> (<?php echo Mail::count_all("WHERE mail_groups_id=" . $MailGroup->id) ?>)</a></td>
                                    <td align="center"><?php echo make_true($MailGroup->newsletter); ?></td>
                                    <td align="center"><?php echo show_published($MailGroup->publish); ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $MailGroup->id; ?>" name="check[]" title="<?php echo $MailGroup->title; ?>" <?php
                                        if ((is_array($checked_row) && in_array($MailGroup->id, $checked_row)) || check_var("checked_row", "GET") == $MailGroup->id) {
                                            echo "checked='checked'";
                                        }
                                        ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                     <table class="button-table" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('MailGroupPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                        <input class="btn btn-success" name="publish"  type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailGroupPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailGroupTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                        <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailGroupsNewsLetter')) { ?>
                                        <label for='home' class="fa fa-home" aria-hidden="true"></label>
                                        <input class="btn btn-primary" id="home" name="newsletter" type="submit" value="<?php echo read_xmls('/site/mailgroup/lables/newsletter') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailGroupEdit')) { ?>
                                         <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailGroupDelete')) { ?>
                                        <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                        <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
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
