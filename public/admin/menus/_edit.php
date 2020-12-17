<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MenuEdit', '_manage.php');

if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$menu = Menu::find_by_id($_GET['id']," AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }


    $menus = new Menu();
    @$menus->id = intval($_GET['id']);
    @$menus->title = trim($_POST['title']);
    @$menus->font_icon = trim($_POST['font_icon']);
    @$menus->parent_id = $_POST['parent_id'];
    @$menus->type = trim($_POST['type']);
    if(isset($_POST['layout'])){
        @$menus->layout = trim($_POST['layout']);
    } else {
      @$menus->layout = $menu->layout;
    }
    @empty($_POST['page_id']) ? $menus->page_id = "Null" : $menus->page_id = $_POST['page_id'];
    @empty($_POST['module_id']) ? $menus->module_id = "Null" : $menus->module_id = $_POST['module_id'];
    @empty($_POST['main_id']) ? $menus->main_id = "Null" : $menus->main_id = $_POST['main_id'];
    @empty($_POST['gallery_id']) ? $menus->gallery_id = "Null" : $menus->gallery_id = $_POST['gallery_id'];
    @empty($_POST['permission_id']) ? $menus->permission_id = "Null" : $menus->permission_id = $_POST['permission_id'];
    @$menus->url = trim($_POST['url']);
    if (isset($_POST['url'])) {
        $menus->module_id = "Null";
        $menus->page_id = "Null";
    }
    @$menus->target = trim($_POST['target']);
     if (@$_POST['parent_id'] == "Null") {
         @$menus->hide_submenu = 0;
     } else {
       if(!$_POST['hide_submenu']){
           @$menus->hide_submenu = 0;
       } else {
         @$menus->hide_submenu = trim($_POST['hide_submenu']);
       }
    }
    @$menus->sort_id = trim($_POST['sort_id']);
    @$menus->publish = $menu->publish;
    @$menus->site_id = $menu->site_id;
    @$menus->lang_id = $menu->lang_id;
    @$menus->menu_type = $menu->menu_type;
    @$menus->created = $menu->created;
    @$menus->updated = current_date();

    if ($menus->save_menu($menu->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Menu: {$menus->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $menu->id);
    } else {
        $message = join("<br/>", $menus->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>

<script language="javascript">
    $(function () {
        $('#link').load('../../aids/getContentType.php?type=<?php echo $menu->type ?>&update=<?php echo $menu->id ?>');
    });
</script>

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
                <h2><?php echo read_xmls('/site/menu/titles/edit') ?> : <?php echo $menu->title; ?></h2>
                <a style="color: #fff;"  class="pull-left btn btn-primary margin-link" href="_manage.php?menu_type=<?php echo $menu->menu_type; ?>"><?php echo read_xmls('/site/menu/titles/manage') ?> <i class="fa fa-th-list" aria-hidden="true"></i></a>
                <?php if ($session->has_permission('MenuTranslate')) { ?>
                    <a style="color: #fff;"  class="pull-left btn btn-info margin-link" href="_translate.php?parent=<?php echo $menu->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?> <i class="fa fa-language" aria-hidden="true"></i></a>
                <?php } ?>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="assign" action="_edit.php?id=<?php echo $menu->id; ?>" method="POST" enctype="multipart/form-data" role="form">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo $menu->title; ?>" maxlength="255">
                                <input type="hidden" name="menu_type" value="<?php echo $menu_type ?>">
                            </div>
                            <?php //if ($menu->menu_type == 1) { ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/fonticon') ?></label>
                                <input class="form-control" type="text" name="font_icon" value="<?php echo $menu->font_icon; ?>" maxlength="255">
                            </div>
                          <?php //}?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/sortid') ?></label>
                                <input class="form-control" type="text" name="sort_id" value="<?php echo $menu->sort_id; ?>" maxlength="255">
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/parent') ?></label>
                                <select  class="form-control" name="parent_id" onchange="showIfNotNull(this.value, 'hidesubmenu', 'table-row');showIfNull(this.value, 'menulayout');">
                                    <option value="Null">..<?php echo read_xmls('/site/menu/lables/toplevel'); ?></option>
                                    <?php
                                    //Get all Menus
                                    $menuParents = Menu::find_all("sort_id ASC", "where site_id={$session->site_id} and  menu_type=" . $database->escape_value($menu->menu_type));
                                    foreach ($menuParents as $menuParent):
                                        $childrins[$menuParent->id] = array(
                                            'id' => $menuParent->id,
                                            'title' => Menu::find_viewed_language('title', $menuParent->id, Menu::$trans_key),
                                            'parent_id' => $menuParent->parent_id
                                        );
                                    endforeach;
                                    echo Menu::generate_tree_options($childrins, NULL, "&nbsp;&nbsp;", 'options', $menu->parent_id);
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php if ($menu->parent_id == null) { ?>
                                    <div id="menulayout">
                                        <label><?php echo read_xmls('/site/menu/lables/menulayout') ?></label>
                                        <input type="radio" name="layout" value="1" <?php if (@$menu->layout == '1') echo "checked" ?>  /><?php echo show_icon('h_dropmenu.png', read_xmls('/site/menu/lables/onecol')); ?>
                                        <input type="radio" name="layout" value="2" <?php if (@$menu->layout == '2') echo "checked" ?> /><?php echo show_icon('v_dropmenu.png', read_xmls('/site/menu/lables/multicol')); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/type') ?></label>
                                <select  class="form-control" name="type" onchange="getData('../../aids/getContentType.php?type=' + this.value, 'link')">
                                    <option value="">-- <?php echo read_xmls('/site/menu/lables/select') ?> --</option>
                                    <?php if ($menu->menu_type == 0) { ?>
                                        <option value="page"<?php if ($menu->type == 'page') echo ' selected'; ?>><?php echo read_xmls('/site/menu/lables/page') ?></option>
                                        <option value="main"<?php if ($menu->type == 'main') echo ' selected'; ?>><?php echo read_xmls('/site/menu/lables/main') ?></option>
                                        <option value="gallery"<?php if ($menu->type == 'gallery') echo ' selected'; ?>><?php echo read_xmls('/site/menu/lables/gallery') ?></option>
                                        <?php if ($session->has_permission('MenuAssignModule')) { ?>
                                            <option value="module"<?php if ($menu->type == 'module') echo ' selected'; ?>><?php echo read_xmls('/site/menu/lables/module') ?></option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="permission"<?php if ($menu->type == 'permission') echo ' selected'; ?>><?php echo read_xmls('/site/menu/lables/permission') ?></option>
                                    <?php } ?>
                                    <option value="extlink"<?php if ($menu->type == 'extlink') echo ' selected'; ?>><?php echo read_xmls('/site/menu/lables/extlink') ?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/link') ?></label>
                                <div id='link'>
                                    <select class="form-control"><option>-- <?php echo read_xmls('/site/menu/lables/none') ?> --</option></select>
                                </div>

                            </div>
                            <div class="form-group">
                                <?php if ($menu->menu_type == 0) { ?>
                                <div id="hidesubmenu"<?php if (@$menu->parent_id == NULL) echo " style='display:none;'" ?>>
                                    <label><?php echo read_xmls('/site/menu/lables/hidesubmenu') ?>:</label>
                                    <td><input type="checkbox" id="hide_submenu" name="hide_submenu" value="1" <?php if (@$menu->hide_submenu == 1) echo "checked" ?>/>&nbsp;</td>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="button-table">
                                <input class="btn btn-primary" id="edit" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="button" />
                                <label for='edit' style="left: 27px" class="fa fa-edit" aria-hidden="true"></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_layout_template('admin_footer.php'); ?>
