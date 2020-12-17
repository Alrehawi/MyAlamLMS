<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PageView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Page();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Make As Homepage
if (check_var("homepage", "POST") && check_var("check", "POST") && $session->check_permission('PageMakeHome', '_manage.php')) {
    return $Action->do_action('defaults', $_POST['check'], get_current_page(), FALSE, " WHERE site_id={$session->site_id} ", 'home');
}

// Make as Contact page
if (check_var("contacts", "POST") && check_var("check", "POST") && $session->check_permission('PageMakeContact', '_manage.php')) {
    return $Action->do_action('defaults', $_POST['check'], get_current_page(), FALSE, " WHERE site_id={$session->site_id} ", 'contact');
}

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('PageEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Move Up
if (check_var("sort_up", "POST") && check_var("check", "POST") && $session->check_permission('PageMove', '_manage.php')) {
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE ," AND site_id={$session->site_id} ");
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("check", "POST") && $session->check_permission('PageMove', '_manage.php')) {
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE," AND site_id={$session->site_id} ");
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('PagePublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('PagePublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('PageTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('PageDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;

$total_count = Page::count_all(" WHERE site_id={$session->site_id} and (".Page::search(@$_GET['s'], array('title', 'url_alias', 'keywords', 'description')).") ");

$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM pages WHERE site_id={$session->site_id} ";
if (!empty($_GET['s'])) {
    $sql .= " and " . Page::search(@$_GET['s'], array('title', 'url_alias', 'keywords', 'description')) . " ";
}
$sql .= " ORDER BY sort_id ASC ";
$sql .= " LIMIT {$per_page} ";
$sql .= " OFFSET {$pagination->offset()}";
$pageObjs = Page::find_by_sql($sql);
?>
<!-- message -->
<div class="row">
  <div class="col-lg-12">
      <?php echo output_message($message); ?>
  </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/page/titles/manage') ?></h2>
                <?php if ($session->has_permission('PageAdd')) { ?>
                    <a style="color: #fff;"  class=" btn btn-primary pull-left"  href="_add.php"><?php echo read_xmls('/site/page/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr >
                                <th><?php echo read_xmls('/site/page/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/page/lables/link') ?></th>
                                <th><?php echo read_xmls('/site/page/lables/homepage') ?></th>
                                <th><?php echo read_xmls('/site/page/lables/contacts') ?></th>
                                <th><?php echo read_xmls('/site/layout/titles/main') ?></th>
                                <!-- <th><?php //echo read_xmls('/site/part/titles/add') ?></th> -->
                                <th><?php echo read_xmls('/site/page/lables/counter') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pageObjs as $pageObj):?>
                                <tr>
                                    <td><?php echo Page::find_viewed_language('title', intval($pageObj->id), Page::$trans_key) ?></td>
                                    <td align="center" valign="middle"><input type="text" value="<?php echo FILE_RELATIVE . DS . "?page=" . $pageObj->url_alias ?>" style="width:200px" /> </td>
                                    <td align="center" valign="middle"><?php echo make_true($pageObj->home); ?></td>
                                    <td align="center" valign="middle"><?php echo make_true($pageObj->contact); ?></td>
                                    <td align="center" valign="middle"><a href="<?php echo get_relative_link(ADMIN . DS . 'layout' . DS . '?page_id=' . $pageObj->id) ?>"><?php echo show_icon('layout.png', read_xmls('/site/layout/titles/main')); ?></a></td>
                                    <!-- <td align="center" valign="middle"><a href="<?php echo get_relative_link(ADMIN . DS . 'parts' . DS . '_add.php?page_id=' . $pageObj->id) ?>"><?php echo show_icon('add.png', read_xmls('/site/part/titles/add')); ?></a></td> -->
                                    <td align="center" valign="middle"><?php echo $pageObj->counter; ?></td>
                                    <td align="center" valign="middle"><?php echo show_published($pageObj->publish); ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $pageObj->id; ?>" name="check[]" title="<?php echo $pageObj->title; ?>" <?php
                                        if ((is_array($checked_row) && in_array($pageObj->id, $checked_row)) || check_var("checked_row", "GET") == $pageObj->id) {
                                            echo "checked='checked'";
                                        }
                                        ?>/></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                     <table  class="button-table pull-right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('PageMakeHome')) { ?>
                                        <label for='publish' style="left: -100px" class="fa fa-home" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="homepage" type="submit" value="<?php echo read_xmls('/site/page/lables/homepage') ?>" id="homepage" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('PageMakeContact')) { ?>
                                        <label for='publish' style="left: -67px" class=" fa-mobile-phone" aria-hidden="true"></label>
                                        <input class="btn btn-info" name="contacts" type="submit" value="<?php echo read_xmls('/site/page/lables/contacts') ?>" id="contacts" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('PagePublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                        <input class="btn btn-success" name="publish"  type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('PagePublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('PageMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('PageMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('PageTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                        <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('PageEdit')) { ?>
                                         <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('PageDelete')) { ?>
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
