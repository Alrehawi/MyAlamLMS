<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MainCategoryAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $user_admin = User::find_by_id($session->user_id);
    if ($_POST['parent_id'] == "Null") {
        $new_sort_id = MainCategory::count_new_sort_id("WHERE parent_id IS NULL AND site_id={$session->site_id}");
    } else {
        $new_sort_id = MainCategory::count_new_sort_id("WHERE site_id={$session->site_id} AND  parent_id=" . intval($_POST['parent_id']));
    }

    $mains = new MainCategory();
    @$mains->title = trim($_POST['title']);
    @$mains->parent_id = $_POST['parent_id'];
    @$mains->module_id = Module::find_alias('module_main_subject.php', 'id');
    @$mains->url_alias = trim($_POST['url_alias']);
    @$mains->paging = intval(trim($_POST['paging']));
    @$mains->content = trim($_POST['content']);
    @$mains->layout = trim($_POST['layout']);
    @$mains->subject_sort = trim($_POST['subject_sort']);
    @$mains->publish = 1;
    @$mains->site_id = $session->site_id;
    @$mains->sort_id = $new_sort_id;
    @$mains->created = current_date();
    // get default lang ID
    $default_lang = Language::get_default_lang();
    @$mains->lang_id = $default_lang[0]->id;

    if ($mains->save_main()) {

        if (@$_POST['add_as_menu'] == 1) {
            //Create menu
            if ($_POST['menu_parent_id'] == "Null") {
                $new_sort_id = Menu::count_new_sort_id("WHERE menu_type=0 AND parent_id IS NULL AND site_id={$session->site_id} ");
            } else {
                $new_sort_id = Menu::count_new_sort_id("WHERE site_id={$session->site_id} AND  parent_id=" . intval($_POST['menu_parent_id']));
            }
            $menus = new Menu();
            @$menus->title = trim($_POST['title']);
            @$menus->parent_id = $_POST['menu_parent_id'];
            @$menus->type = 'main';
            @$menus->page_id = 'Null';
            @$menus->module_id = "Null";
            @$menus->permission_id = "Null";
            @$menus->main_id = $mains->id;
            @$menus->gallery_id = "Null";
            @$menus->url = '';
            @$menus->target = '';
            @$menus->hide_submenu = 0;
            @$menus->site_id = $session->site_id;
            @$menus->publish = 1;
            @$menus->menu_type = 0;
            @$menus->layout = 1;
            @$menus->sort_id = $new_sort_id;
            @$menus->created = current_date();
            @$menus->lang_id = $default_lang[0]->id;
            @$menus->save_menu();
        }

        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Main Category Item: {$mains->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $mains->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/main/titles/add') ?></h2>
                    <a class=" btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/main/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                       <form name="assign" action="_add.php" method="POST" enctype="multipart/form-data">
                         <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/main/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" />
                                    <?php echo read_xmls('/site/main/lables/charnum') ?></label>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/main/lables/urlalias') ?></label>

                                <input class="form-control" name="url_alias" type="text" id="url_alias" value="<?php
                                    if (@$_POST['url_alias']) {
                                        echo @$_POST['url_alias'];
                                    } else {
                                        echo create_alias('main');
                                    }
                                    ?>" onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                    <?php echo read_xmls('/site/gallery/lables/charnum') ?></label>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/main/lables/parent') ?></label>
                                <select  class="form-control" name="parent_id" id="parent_id">
                                        <option value="Null">..<?php echo read_xmls('/site/main/lables/toplevel'); ?></option>
                                        <?php
                                        //Get all MainCategorys
                                        $mains = MainCategory::find_all("sort_id ASC"," WHERE site_id={$session->site_id}");
                                        foreach ($mains as $main):
                                            $childrins[$main->id] = array(
                                                'id' => $main->id,
                                                'title' => $main->title,
                                                'parent_id' => $main->parent_id
                                            );

                                        endforeach;
                                        echo MainCategory::generate_tree_options($childrins);
                                        ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/main/lables/paging') ?></label>
                                <input class="form-control" type="text" name="paging" value="<?php
                                    if (check_var("paging", "POST")) {
                                        echo check_var("paging", "POST");
                                    } else {
                                        echo 20;
                                    }
                                    ?>"  maxlength="2" onkeypress='return isNumberKey(event)'/>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/main/lables/layout') ?></label>
                                <input  type="radio" name="layout" value="1" checked="checked" /><?php echo show_icon('list_bullets.png', read_xmls('/site/main/lables/layout')); ?>
                                    <input type="radio" name="layout" value="2" /><?php echo show_icon('grid.png', read_xmls('/site/main/lables/layout')); ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/main/lables/subjectsort') ?></label>

                                <input type="radio" name="subject_sort" value="ASC" checked="checked" /><?php echo show_icon('asc.png', read_xmls('/site/main/lables/subjectsort')); ?>
                                <input type="radio" name="subject_sort" value="DESC" /><?php echo show_icon('desc.png', read_xmls('/site/main/lables/subjectsort')); ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/main/lables/content') ?></label>
                                <?php
                                    $getValue = @$_POST['content'];
                                    $getField = 'content';
                                    $getBaseFolder = '../../aids/ckeditor/';
                                    $getType = 'larg';
                                    include('../../aids/editor.php');
                                    ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/addtomenu') ?></label>
                                <input type="checkbox" name="add_as_menu" id="add_as_menu" value="1" onclick="showMeJQ('addasmenu_tr')"/>
                            </div>
                            <div class="form-group" id="addasmenu_tr" style="display: none;">
                                <label><?php echo read_xmls('/site/menu/lables/parent') ?></label>
                                <select  class="form-control" name="menu_parent_id" onchange="showIfNotNull(this.value, 'hidesubmenu', 'table-row');">
                                        <option value="Null">..<?php echo read_xmls('/site/menu/lables/toplevel'); ?></option>
                                        <?php
                                        //Get all Menus
                                        $menus = Menu::find_all("sort_id ASC", " where menu_type=0 AND site_id={$session->site_id} ");
                                        foreach ($menus as $menu):
                                            $childrins_menu[$menu->id] = array(
                                                'id' => $menu->id,
                                                'title' => Menu::find_viewed_language('title', $menu->id, Menu::$trans_key),
                                                'parent_id' => $menu->parent_id
                                            );

                                        endforeach;
                                        echo Menu::generate_tree_options($childrins_menu);
                                        ?>
                                    </select>

                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>" class="btn btn-primary" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
