<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MainCategoryView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new MainCategory();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('MainCategoryEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('MainCategoryTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('MainCategoryDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('MainCategoryPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('MainCategoryPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}


// Do Move Up
if (check_var("sort_up", "POST") && check_var("check", "POST") && $session->check_permission('MainCategoryMove', '_manage.php')) {
    $getpartemt = MainCategory::find_by_id($_POST['check'][0]);
    empty($getpartemt->parent_id) ? $cond = " AND site_id={$session->site_id} AND parent_id IS NULL " : $cond = " AND site_id={$session->site_id} AND parent_id=" . $getpartemt->parent_id . " ";
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, $cond);
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("check", "POST") && $session->check_permission('MainCategoryMove', '_manage.php')) {
    $getpartemt = MainCategory::find_by_id($_POST['check'][0]);
    empty($getpartemt->parent_id) ? $cond = " AND site_id={$session->site_id} AND parent_id IS NULL " : $cond = " AND site_id={$session->site_id}  AND parent_id=" . $getpartemt->parent_id . " ";
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE, $cond);
}
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
             <h2><?php echo read_xmls('/site/main/titles/manage') ?></h2>
                <?php if ($session->has_permission('MainCategoryAdd')) { ?>
                    <a class="pull-left btn btn-primary" href="_add.php"><?php echo read_xmls('/site/main/titles/add') ?> <i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/main/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/main/lables/link') ?></th>
                                <th><?php echo read_xmls('/site/main/lables/addsubject') ?></th>
                                <th><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $childrins = array();
                        if (!empty($_GET['s'])) {
                            $mains = MainCategory::find_all("sort_id ASC", "WHERE " . MainCategory::search(@$_GET['s'], array('title')) . " AND site_id={$session->site_id} ");
                        } else {
                            $mains = MainCategory::find_all("sort_id ASC" , " WHERE site_id={$session->site_id} ");
                        }
                        foreach ($mains as $main):
                            $childrins[$main->id] = array(
                                'id' => $main->id,
                                'title' => "<a href='" . get_relative_link(ADMIN . DS . 'subjects' . DS . '_manage.php?main_id=' . $main->id) . "'>" . MainCategory::find_viewed_language('title', intval($main->id), MainCategory::$trans_key) . " (" . Subject::count_all("WHERE main_id=" . $main->id) . ")</a>",
                                'parent_id' => $main->parent_id,
                                'link' => "<input type='text' value='" . FILE_RELATIVE . DS . "?module=" . Module::find_alias('module_main_subject.php') . "&main_subject=" . $main->url_alias . "' style='width:200px' />",
                                'addsubject' => "<a href='" . get_relative_link(ADMIN . DS . 'subjects' . DS . '_add.php') . "?main_id=" . $main->id . "'><img src='" . get_relative_link() . 'back_images' . DS . "add.png" . "' title='" . read_xmls('/site/subject/titles/main') . "'/></a>",
                                'publish' => show_published($main->publish)
                            );

                        endforeach;
                        echo MainCategory::generate_tree_options($childrins, NULL, "", 'rows');?>
                        </tbody>
                    </table>

                     <table class="button-table" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('MainCategoryMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MainCategoryMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MainCategoryPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                         <input class="btn btn-success" name="publish"  type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MainCategoryPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('MainCategoryTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                         <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('MainCategoryEdit')) { ?>
                                         <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('MainCategoryDelete')) { ?>
                                        <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                                        <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>" class="button" />
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
