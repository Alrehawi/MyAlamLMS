<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('GalleryAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $user_admin = User::find_by_id($session->user_id);
    // assign new sort id
    $galleries = new Gallery();
    @$galleries->title = trim($_POST['title']);
    @$galleries->url_alias = trim($_POST['url_alias']);
    @$galleries->module_id = Module::find_alias('module_gallery.php', 'id');
    @$galleries->folder = trim($_POST['folder']);
    @$galleries->paging = intval(trim($_POST['paging']));
    @$galleries->thumb_height = intval(trim($_POST['thumb_height']));
    @$galleries->thumb_width = intval(trim($_POST['thumb_width']));
    @$galleries->image_height = intval(trim($_POST['image_height']));
    @$galleries->image_width = intval(trim($_POST['image_width']));
    // get default lang ID
    @$default_lang = Language::get_default_lang();
    @$galleries->lang_id = $default_lang[0]->id;
    @$galleries->site_id = $session->site_id;

    @$galleries->publish = 1;
    @$galleries->created = current_date();
    // get default lang ID

    if ($galleries->save_gallery()) {

        if (@$_POST['add_as_menu'] == 1) {
            //Create menu
            if ($_POST['parent_id'] == "Null") {
                $new_sort_id = Menu::count_new_sort_id("WHERE menu_type=0 AND parent_id IS NULL AND site_id={$session->site_id} ");
            } else {
                $new_sort_id = Menu::count_new_sort_id("WHERE site_id={$session->site_id} AND parent_id=" . intval($_POST['parent_id']));
            }
            $menus = new Menu();
            @$menus->title = trim($_POST['title']);
            @$menus->parent_id = $_POST['parent_id'];
            @$menus->type = 'gallery';
            @$menus->page_id = "Null";
            @$menus->module_id = "Null";
            @$menus->permission_id = "Null";
            @$menus->main_id = "Null";
            @$menus->gallery_id = @$galleries->id;
            @$menus->url = '';
            @$menus->target = '';
            @$menus->hide_submenu = 0;
            @$menus->publish = 1;
            @$menus->menu_type = 0;
            @$menus->layout = 1;
            @$menus->sort_id = $new_sort_id;
            @$menus->site_id = $session->site_id;
            @$menus->created = current_date();
            @$menus->lang_id = $default_lang[0]->id;
            @$menus->save_menu();
        }

        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Gallery: {$galleries->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $galleries->errors);
    }
}
$alias_h = create_alias('gallery');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
            <div  class="panel-heading">
                <h2><?php echo read_xmls('/site/gallery/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/gallery/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                       <form name="gallery" action="_add.php" method="POST" enctype="multipart/form-data">
                         <?php echo setToken() ?>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/gallery/lables/name') ?></label>
                                    <input type="text" class="form-control" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" />
                                        <?php echo read_xmls('/site/gallery/lables/charnum') ?></label>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/gallery/lables/urlalias') ?></label>
                                    <input class="form-control" name="url_alias" type="text" id="url_alias" value="<?php
                                        if (@$_POST['url_alias']) {
                                            echo @$_POST['url_alias'];
                                        } else {
                                            echo $alias_h;
                                        }
                                        ?>" onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                        <?php echo read_xmls('/site/gallery/lables/charnum') ?></label>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/gallery/lables/folder') ?></label>
                                    <input type="text" class="form-control" name="folder" value="<?php
                                        if (check_var("folder", "POST")) {
                                            echo check_var("folder", "POST");
                                        } else {
                                            echo $alias_h;
                                        }
                                        ?>"  onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                        <?php echo read_xmls('/site/gallery/lables/charnum') ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/gallery/lables/paging') ?></label>
                                    <input type="text" class="form-control" name="paging" value="<?php
                                        if (check_var("paging", "POST")) {
                                            echo check_var("paging", "POST");
                                        } else {
                                            echo 21;
                                        }
                                        ?>"  maxlength="2" onkeypress='return isNumberKey(event)'/>
                                </div>
                                <div  class="form-group">
                                    <label><?php echo read_xmls('/site/menu/lables/addtomenu') ?></label>
                                    <input type="checkbox" name="add_as_menu" id="add_as_menu" value="1" onclick="showMeJQ('addasmenu_tr')"/>
                                </div>
                                <div id="addasmenu_tr" style="display: none;">
                                    <label><?php echo read_xmls('/site/menu/lables/parent') ?></label>
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
                                        </select><br>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/gallery/lables/thumbwidth') ?></label>
                                    <input type="text" name="thumb_width" value="<?php
                                        if (@$_POST['thumb_width'])
                                            echo $_POST['thumb_width'];
                                        else
                                            echo 200;
                                        ?>" maxlength="3" onkeypress='return isNumberKey(event)' style="width:30%"/>
                                         X
                                        <input type="text" name="thumb_height" value="<?php
                                        if (@$_POST['thumb_height'])
                                            echo $_POST['thumb_height'];
                                        else
                                            echo 200;
                                        ?>" maxlength="3" onkeypress='return isNumberKey(event)' style="width:30%"/>
                                       <label> [PX] <?php echo read_xmls('/site/gallery/lables/thumbheight') ?></label>
                                </div>

                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/gallery/lables/imagewidth') ?></label>
                                    <input style="width:30%" type="text" name="image_width" value="<?php
                                        if (@$_POST['image_width'])
                                            echo $_POST['image_width'];
                                        else
                                            echo 1500;
                                        ?>" maxlength="3" onkeypress='return isNumberKey(event)'/>
                                        X
                                        <input style="width:30%" type="text" name="image_height" value="<?php
                                        if (@$_POST['image_height'])
                                            echo $_POST['image_height'];
                                        else
                                            echo 1500;
                                        ?>" maxlength="3" onkeypress='return isNumberKey(event)'>
                                        <label>[PX] <?php echo read_xmls('/site/gallery/lables/imageheight') ?></label>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>" class="btn btn-primary"/>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
