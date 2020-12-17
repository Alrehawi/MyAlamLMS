<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PageAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    // assign new sort id
    $new_sort_id = Page::count_new_sort_id("WHERE site_id={$session->site_id}");

    $user_admin = User::find_by_id($session->user_id);
    @$pages = new Page();
    @$pages->title = trim($_POST['title']);
    @$pages->content = trim($_POST['content']);
    @$pages->url_alias = trim($_POST['url_alias']);
    @$pages->module_id = $_POST['module_id'];
    @$pages->keywords = trim($_POST['keywords']);
    @$pages->description = trim($_POST['description']);
    @$pages->sort_id = $new_sort_id;
    @$pages->publish = 1;
    @$pages->site_id = $session->site_id;
    @$pages->created = current_date();
    // get default lang ID
    $default_lang = Language::get_default_lang();
    $pages->lang_id = $default_lang[0]->id;

    if ($pages->save_page()) {
        //create layout
        $layouts = new Layout();
        @$layouts->page_id = @$pages->id;
        @$layouts->defaults = 2;
        @$layouts->site_id = $session->site_id;
        @$layouts->module_id = "Null";
        @$layouts->updated = current_date();
        $layouts->save();

        // //Create new part
        // @$parts = new Part();
        // @$parts->title = trim($_POST['title']);
        // @$parts->page_id = @$pages->id;
        // @$parts->show_title = 0;
        // @$parts->content = trim($_POST['content']);
        // @$parts->sort_id = 1;
        // @$parts->publish = 1;
        // @$parts->created = current_date();
        // // get default lang ID
        // @$parts->lang_id = $default_lang[0]->id;
        // @$parts->save_part();

        if (@$_POST['add_as_menu'] == 1) {
            //Create menu
            if ($_POST['parent_id'] == "Null") {
                $new_sort_id = Menu::count_new_sort_id("WHERE menu_type=0 AND parent_id IS NULL AND site_id={$session->site_id}");
            } else {
                $new_sort_id = Menu::count_new_sort_id("WHERE site_id={$session->site_id} and parent_id=" . intval($_POST['parent_id']));
            }
            $menus = new Menu();
            @$menus->title = trim($_POST['title']);
            @$menus->parent_id = $_POST['parent_id'];
            @$menus->type = 'page';
            @$menus->page_id = @$pages->id;
            @$menus->module_id = "Null";
            @$menus->permission_id = "Null";
            @$menus->main_id = "Null";
            @$menus->gallery_id = "Null";
            @$menus->url = '';
            @$menus->target = '';
            @$menus->hide_submenu = 0;
            @$menus->publish = 1;
            @$menus->site_id = $session->site_id;
            @$menus->menu_type = 0;
            @$menus->layout = 1;
            @$menus->sort_id = $new_sort_id;
            @$menus->created = current_date();
            @$menus->lang_id = $default_lang[0]->id;
            @$menus->save_menu();
        }

        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Page: {$pages->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $pages->errors);
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
                <h2><?php echo read_xmls('/site/page/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/page/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label>&nbsp;<?php echo read_xmls('/site/page/lables/name') ?> </label>
                                <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255">
                                    <?php echo read_xmls('/site/page/lables/charnum') ?>
                            </div>

                            <div class="form-group">

                            </div>

                            <div class="form-group">
                                <label>&nbsp;<?php echo read_xmls('/site/page/lables/urlalias') ?> </label>
                                <input class="form-control" name="url_alias" type="text" id="url_alias" value="<?php
                                if (@$_POST['url_alias']) {
                                    echo @$_POST['url_alias'];
                                } else {
                                    echo create_alias();
                                }
                                ?>" onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                <?php echo read_xmls('/site/page/lables/charnum') ?>
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/page/lables/content') ?></label>

                                <?php
                                $getValue = check_var("content", "POST");
                                $getField = 'content';
                                $getBaseFolder = '../../aids/ckeditor/';
                                $getType = 'larg';
                                include('../../aids/editor.php');
                                ?>
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/menu/lables/addtomenu') ?>:</label>
                                <input type="checkbox" name="add_as_menu" id="add_as_menu" value="1" onclick="showMeJQ('addasmenu_tr')"/>
                            </div>

                            <div class="form-group">
                                <div id="addasmenu_tr" style="display: none;">
                                    <label><?php echo read_xmls('/site/menu/lables/parent') ?>:</label>
                                    <select  class="form-control" name="parent_id" onchange="showIfNotNull(this.value, 'hidesubmenu', 'table-row');">
                                        <option value="Null">..<?php echo read_xmls('/site/menu/lables/toplevel'); ?></option>
                                        <?php
                                        //Get all Menus
                                        $menus = Menu::find_all("sort_id ASC", "where menu_type=0 AND site_id={$session->site_id}");
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

                                 </tr>
                            </div>

                            <div class="form-group">
                               <label>&nbsp;<?php echo read_xmls('/site/page/lables/module') ?></label>
                               <select  class="form-control" name="module_id">
                                    <option value="Null"><?php echo read_xmls('/site/page/lables/select'); ?></option>
                                    <?php
                                    //Get all Categories
                                    $modules = module::find_all("title ASC", " WHERE publish=1 AND site_id={$session->site_id}");
                                    foreach ($modules as $module):
                                        ?>
                                        <option value='<?php echo $module->id; ?>'<?php
                                        if (check_var("module_id", "POST") == $module->id) {
                                            echo ' selected';
                                        }
                                        ?>><?php echo $module->title; ?></option>
                                            <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>&nbsp;<?php echo read_xmls('/site/page/lables/keywords') ?>:</label>
                                <textarea class="form-control" name="keywords" cols="30" rows="5"><?php echo check_var("keywords", "POST"); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>&nbsp;<?php echo read_xmls('/site/page/lables/description') ?>:</label>
                                <textarea class="form-control" name="description" cols="30" rows="5"><?php echo check_var("description", "POST"); ?></textarea>
                            </div>
                            <div class="form-group">
                               <label>&nbsp;</label>
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
