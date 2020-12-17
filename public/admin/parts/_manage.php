<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PartView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Part();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('PartEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Move Up
if (check_var("sort_up", "POST") && check_var("page_id", "POST") && check_var("check", "POST") && $session->check_permission('PartMove', '_manage.php')) {
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, " AND page_id=" . $_POST['page_id'] . " ");
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("page_id", "POST") && check_var("check", "POST") && $session->check_permission('PartMove', '_manage.php')) {
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE, " AND page_id=" . $_POST['page_id'] . " ");
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('PartPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('PartPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('PartTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('PartDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}
?>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/part/titles/manage') ?></h2>
                <?php if ($session->has_permission('PartAdd')) { ?>
                    <a class="btn btn-primary pull-left" href="_add.php"><?php echo read_xmls('/site/part/titles/add') ?><i class="fa fa-plus"></i> </a>
                <?php } ?>
            </div>
            <form name="assign" action="<?php echo get_current_page(); ?>" method="POST">
                <?php echo read_xmls('/site/page/titles/main') ?>:
                <select  class="form-control" name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'page_id', ''); ?>')">
                    <option value=""><?php echo read_xmls('/site/part/lables/select') ?></option>
                    <?php
                    $pages = Page::find_all("title ASC","WHERE site_id={$session->site_id}");
                    foreach ($pages as $page) {
                        ?>
                        <option value="<?php echo $page->id ?>"<?php if (check_var('page_id', 'GET') == $page->id) {
                        echo ' selected';
                    } ?>><?php echo Page::find_viewed_language('title', $page->id, Page::$trans_key); ?></option>
            <?php } ?>
                </select>
            </form>
            <br />
<?php
if (isset($_GET['page_id']) && !empty($_GET['page_id'])) {
    $page_id = intval($_GET['page_id']);

// start pagination
    $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
    if (SiteConfig::site_config('paging'))
        $per_page = SiteConfig::site_config('paging');
    else
        $per_page = 20;
    $total_count = Part::count_all("WHERE page_id=" . $database->escape_value($page_id) . " AND (" . Part::search(@$_GET['s'], array('title', 'content')) . ") ");
    $pagination = new Pagination($page, $per_page, $total_count);
    $sql = "SELECT * FROM parts WHERE page_id=" . $database->escape_value($page_id) . " ";
    if (!empty($_GET['s'])) {
        $sql .= "AND (" . Part::search(@$_GET['s'], array('title', 'content')) . ") ";
    }
    $sql .= "ORDER BY sort_id ASC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $partObjs = Part::find_by_sql($sql);
    ?>
    <?php
    $hidden_input = "<input type='hidden' name='page_id' value='" . @$page_id . "' />";
    ?>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo $hidden_input?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr >
                                <th><?php echo read_xmls('/site/part/lables/name') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($partObjs as $partObj):?>
                            <tr>
                                <td><?php echo Part::find_viewed_language('title', intval($partObj->id), Part::$trans_key) ?></td>
                                <td align="center" valign="middle"><?php echo show_published($partObj->publish); ?></td>
                                <td align="center"><input type="checkbox" value="<?php echo $partObj->id; ?>" name="check[]" title="<?php echo $partObj->title; ?>" <?php if ((is_array($checked_row) && in_array($partObj->id, $checked_row)) || check_var("checked_row", "GET") == $partObj->id) {
                                    echo "checked='checked'";
                                } ?>/></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="button-table" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('PartPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                         <input class="btn btn-success" name="publish"  type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish" class="button" />
                                        <input type="hidden" name="page_id" value="<?php echo $page_id ?>" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('PartPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('PartMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('PartMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('PartTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                         <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                         <?php } ?>
                                         <?php if ($session->has_permission('PartEdit')) { ?>
                                         <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                             <?php } ?>
                                             <?php if ($session->has_permission('PartDelete')) { ?>
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
