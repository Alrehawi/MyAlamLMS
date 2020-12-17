<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$menu_type = 0;
if (check_var("menu_type", "GET") == 1) {
    $menu_type = 1;
}
$session->check_permission('MenuAdd', '_manage.php?menu_type=' . $menu_type);
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }


    $user_admin = User::find_by_id($session->user_id);
    if ($_POST['parent_id'] == "Null") {
        $new_sort_id = Menu::count_new_sort_id("WHERE menu_type={$menu_type} AND parent_id IS NULL AND site_id={$session->site_id} ");
    } else {
        $new_sort_id = Menu::count_new_sort_id("WHERE site_id={$session->site_id} and parent_id=" . intval($_POST['parent_id']));
    }
    // assign new sort id
    //$new_sort_id = Menu::count_new_sort_id();
    $menus = new Menu();
    @$menus->title = trim($_POST['title']);
    @$menus->font_icon = trim($_POST['font_icon']);
    @$menus->parent_id = $_POST['parent_id'];
    @$menus->type = trim($_POST['type']);

    @empty($_POST['page_id']) ? $menus->page_id = "Null" : $menus->page_id = $_POST['page_id'];
    @empty($_POST['module_id']) ? $menus->module_id = "Null" : $menus->module_id = $_POST['module_id'];
    @empty($_POST['main_id']) ? $menus->main_id = "Null" : $menus->main_id = $_POST['main_id'];
    @empty($_POST['gallery_id']) ? $menus->gallery_id = "Null" : $menus->gallery_id = $_POST['gallery_id'];
    @empty($_POST['permission_id']) ? $menus->permission_id = "Null" : $menus->permission_id = $_POST['permission_id'];
    @$menus->url = trim($_POST['url']);
    @$menus->target = trim($_POST['target']);

    if(!@$_POST['hide_submenu']){
        @$menus->hide_submenu = 0;
    } else {
      @$menus->hide_submenu = trim($_POST['hide_submenu']);
    }
    if(!@$_POST['layout']){
        @$menus->layout = 1;
    } else {
      @$menus->layout = trim($_POST['layout']);
    }
    @$menus->publish = 1;
    @$menus->site_id = $session->site_id;
    @$menus->menu_type = trim($_POST['menu_type']);
    @$menus->sort_id = $new_sort_id;
    @$menus->created = current_date();
    // get default lang ID
    $default_lang = Language::get_default_lang();
    $menus->lang_id = $default_lang[0]->id;

    if ($menus->save_menu()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Menu Item: {$menus->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php?menu_type=" . $menu_type);
    } else {
        $message = join("<br/>", $menus->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/menu/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php?menu_type=<?php echo $menu_type; ?>"><?php echo read_xmls('/site/menu/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="assign" action="_add.php?menu_type=<?php echo $menu_type; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" />
                                    <input type="hidden" name="menu_type" value="<?php echo $menu_type ?>">
                                    <?php echo read_xmls('/site/menu/lables/charnum') ?>
                            </div>
                            <?php //if ($menu_type == 1) { ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/fonticon') ?></label>
                                <input class="form-control" type="text" name="font_icon" value="<?php echo check_var("font_icon", "POST"); ?>" maxlength="255" />
                            </div>
                          <?php //}?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/parent') ?></label>
                                <select  class="form-control" name="parent_id" onchange="showIfNotNull(this.value, 'hidesubmenu', 'block');showIfNull(this.value, 'menulayout');">
                                    <option value="Null">..<?php echo read_xmls('/site/menu/lables/toplevel'); ?></option>
                                    <?php
                                    //Get all Menus
                                    $menus = Menu::find_all("sort_id ASC", "where site_id={$session->site_id} and  menu_type=" . $database->escape_value($menu_type));
                                    foreach ($menus as $menu):
                                        $childrins[$menu->id] = array(
                                            'id' => $menu->id,
                                            'title' => Menu::find_viewed_language('title', $menu->id, Menu::$trans_key),
                                            'parent_id' => $menu->parent_id
                                        );

                                    endforeach;
                                    echo Menu::generate_tree_options($childrins);
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <?php if ($menu_type == 0) { ?>
                                    <div id="menulayout">
                                        <label><?php echo read_xmls('/site/menu/lables/menulayout') ?></label>
                                        <input type="radio" name="layout" value="1" checked="checked" /><?php echo show_icon('h_dropmenu.png', read_xmls('/site/menu/lables/onecol')); ?>
                                        <input type="radio" name="layout" value="2" /><?php echo show_icon('v_dropmenu.png', read_xmls('/site/menu/lables/multicol')); ?>
                                    </div>
                                <?php } ?>
                            </div>


                            <div class="form-group">
                                <?php if ($menu_type == 0) { ?>
                                    <div id="hidesubmenu" style="display:none;">
                                        <label><?php echo read_xmls('/site/menu/lables/hidesubmenu') ?></label>
                                        <input type="checkbox" name="hide_submenu" id="hide_submenu" value="1" <?php if (@$_POST['hide_submenu'] == 1) echo "checked" ?>/>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/type') ?></label>
                                <select  class="form-control" name="type" onchange="getData('../../aids/getContentType.php?type=' + this.value, 'link')">
                                    <option value="">-- <?php echo read_xmls('/site/menu/lables/select') ?> --</option>
                                    <?php if ($menu_type == 0) { ?>
                                        <option value="page"><?php echo read_xmls('/site/menu/lables/page') ?></option>
                                        <option value="main"><?php echo read_xmls('/site/menu/lables/main') ?></option>
                                        <option value="gallery"><?php echo read_xmls('/site/menu/lables/gallery') ?></option>
                                        <?php if ($session->has_permission('MenuAssignModule')) { ?>
                                            <option value="module"><?php echo read_xmls('/site/menu/lables/module') ?></option>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <option value="permission"><?php echo read_xmls('/site/menu/lables/permission') ?></option>
                                    <?php } ?>
                                    <option value="extlink"><?php echo read_xmls('/site/menu/lables/extlink') ?></option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/link') ?></label>
                                <div id='link'>
                                    <select class="form-control"><option>-- <?php echo read_xmls('/site/menu/lables/none') ?> --</option></select>
                                </div>
                            </div>

                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>" class="button" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
