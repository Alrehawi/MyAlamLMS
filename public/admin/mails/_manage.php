<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Mail();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('MailEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('MailPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('MailPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('MailDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}
?>
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/mail/titles/manage') ?></h2>
                <?php if ($session->has_permission('MailAdd')) { ?>
                    <a class="btn btn-primary pull-left margin-link" href="_add.php"><?php echo read_xmls('/site/mail/titles/add') ?><i class="fa fa-plus"></i></a>
                    <a class="btn btn-primary pull-left" href="_add_list.php"><?php echo read_xmls('/site/mail/titles/addlist') ?>
                       <i class="fa fa-plus"></i>
                    </a>
                <?php } ?>
                <form name="assign" action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <?php echo read_xmls('/site/mailgroup/titles/main') ?>:
                    <select  class="form-control" name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'mail_groups_id', ''); ?>')">
                        <option value=""><?php echo read_xmls('/site/part/lables/select') ?></option>
                        <?php
                        $mains = MailGroup::find_all("title ASC","WHERE site_id={$session->site_id}");
                        foreach ($mains as $main) {
                            ?>
                            <option value="<?php echo $main->id ?>"<?php if (check_var('mail_groups_id', 'GET') == $main->id) {
                            echo ' selected';
                        } ?>><?php echo $main->title ?> (<?php echo Mail::count_all("WHERE mail_groups_id=" . $main->id) ?>)</option>
                <?php } ?>
                    </select>
                </form>
            </div>



<?php
if (isset($_GET['mail_groups_id']) && !empty($_GET['mail_groups_id'])) {
    $mail_groups_id = intval($_GET['mail_groups_id']);

// start pagination
    $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
    $per_page = 50;
    $total_count = Mail::count_all("WHERE mail_groups_id=" . $database->escape_value($mail_groups_id) . " AND (" . Mail::search(@$_GET['s'], array('email', 'mobile')) . ") ");

    $pagination = new Pagination($page, $per_page, $total_count);
    $sql = "SELECT * FROM mails WHERE mail_groups_id=" . $database->escape_value($mail_groups_id) . " ";

    if (!empty($_GET['s'])) {
        $sql .= "AND (" . Mail::search(@$_GET['s'], array('email', 'mobile')) . ") ";
    }
    $sql .= "ORDER BY id DESC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $mailObjs = Mail::find_by_sql($sql);
    ?>
    <?php
    $hidden_input = "<input type='hidden' name='mail_groups_id' value='" . @$mail_groups_id . "' />";?>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo $hidden_input?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr >
                                <th><?php echo read_xmls('/site/mail/lables/name') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                            foreach ($mailObjs as $mailObj):
                                ?>
                                        <tr>
                                            <td><?php echo Mail::find_viewed_language('email', intval($mailObj->id), 'mail') ?></td>
                                            <td align="center" valign="middle"><?php echo show_published($mailObj->publish); ?></td>
                                            <td align="center"><input type="checkbox" value="<?php echo $mailObj->id; ?>" name="check[]" email="<?php echo $mailObj->email; ?>" <?php if ((is_array($checked_row) && in_array($mailObj->id, $checked_row)) || check_var("checked_row", "GET") == $mailObj->id) {
                                    echo "checked='checked'";
                                } ?>/></td>
                                        </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                      <table class="button-table" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('MailPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                         <input class="btn btn-success" name="publish"  type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish" class="button" />
                                        <input type="hidden" name="mail_groups_id" value="<?php echo $mail_groups_id ?>" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MailTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                         <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                    <?php } ?>
                                     <?php if ($session->has_permission('MailEdit')) { ?>
                                         <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                     <?php } ?>
                                    <?php if ($session->has_permission('MailDelete')) { ?>
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


<?php } ?>
<?php include_layout_template('admin_footer.php'); ?>
