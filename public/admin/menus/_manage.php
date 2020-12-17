<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}

$menu_type = 0;
$site_id_cond = " AND site_id={$session->site_id} ";
if (check_var("menu_type", "GET") == 1) {
    $menu_type = 1;
    $site_id_cond = '';
}

$session->check_permission('MenuView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>

<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Menu();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('MenuEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('MenuTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('MenuDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('MenuPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('MenuPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}


// Do Move Up
if (check_var("sort_up", "POST") && check_var("check", "POST") && $session->check_permission('MenuMove', '_manage.php')) {
    $getpartemt = Menu::find_by_id($_POST['check'][0]);
    empty($getpartemt->parent_id) ? $cond = " AND parent_id IS NULL  AND menu_type={$menu_type} {$site_id_cond} " : $cond = " AND menu_type={$menu_type} and parent_id=" . $getpartemt->parent_id . "  {$site_id_cond}  ";
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, $cond);
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("check", "POST") && $session->check_permission('MenuMove', '_manage.php')) {
    $getpartemt = Menu::find_by_id($_POST['check'][0]);
    empty($getpartemt->parent_id) ? $cond = " AND parent_id IS NULL  AND menu_type={$menu_type} {$site_id_cond} " : $cond = " AND menu_type={$menu_type} and parent_id=" . $getpartemt->parent_id . "  {$site_id_cond}  ";
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
             <h2><?php echo read_xmls('/site/menu/titles/manage'); ?>
                <?php if ($session->has_permission('MenuAdd')) { ?></h2>
                <a style="color: #fff;"  class="pull-left btn btn-primary" href="_add.php?menu_type=<?php echo $menu_type; ?>"><?php echo read_xmls('/site/menu/titles/add') ?> <i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr ordering= false>
                                <th class="text-center">
                                    <?php echo read_xmls('/site/menu/lables/name') ?>
                                </th>
                                <th width='80'class="text-center">
                                    <?php echo read_xmls('/site/adminactions/publish') ?>
                                </th>
                                <th class="no-sort" width='80'class="text-center">
                                    <input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" />
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                            $childrins = array();
                            if (!empty($_GET['s'])) {
                                $menus = Menu::find_all("sort_id ASC", "where menu_type=" . $database->escape_value($menu_type) . " and " . Menu::search(@$_GET['s'], array('title')) . " {$site_id_cond} ");
                            } else {
                                $menus = Menu::find_all("sort_id ASC", "where menu_type=" . $database->escape_value($menu_type) . " {$site_id_cond} ");
                            }
                            foreach ($menus as $menu):
                                $childrins[$menu->id] = array(
                                    'id' => $menu->id,
                                    'title' => Menu::find_viewed_language('title', $menu->id, Menu::$trans_key),
                                    'parent_id' => $menu->parent_id,
                                    'sort_id' => $menu->sort_id,
                                    'publish' => show_published($menu->publish)
                                );

                            endforeach;
                            echo Menu::generate_tree_options($childrins, NULL, "", 'rows');
                            ?>
                            <!-- <tr class="odd gradeX">
                                <td>Trident</td>
                                <td>Internet Explorer 4.0</td>
                                <td>Win 95+</td>
                                <td class="center">4</td>
                                <td class="center">X</td>
                            </tr> -->
                        </tbody>
                    </table>

                     <table class="button-table" style="float: right;" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('MenuMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MenuMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  />
                                    <?php } ?>
                                    <?php if ($session->has_permission('MenuPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                        <input class="btn btn-success" name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MenuPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MenuTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                        <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MenuEdit')) { ?>
                                        <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MenuDelete')) { ?>
                                        <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                        <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"/>
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
