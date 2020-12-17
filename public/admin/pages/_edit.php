<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PageEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$page = Page::find_by_id($_GET['id']," AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $pages = new Page();
    @$pages->id = $_GET['id'];
    @$pages->title = trim($_POST['title']);
    @$pages->content = trim($_POST['content']);
    @$pages->url_alias = trim($_POST['url_alias']);
    @$pages->module_id = $_POST['module_id'];
    @$pages->keywords = trim($_POST['keywords']);
    @$pages->description = trim($_POST['description']);
    @$pages->lang_id = $page->lang_id;
    @$pages->sort_id = $page->sort_id;
    @$pages->home = $page->home;
    @$pages->contact = $page->contact;
    @$pages->publish = $page->publish;
    @$pages->site_id = $session->site_id;
    @$pages->created = $page->created;
    @$pages->updated = current_date();

    if ($pages->save_page($page->id)) {

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
            @$menus->page_id = $page->id;
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
            @$menus->lang_id = $page->lang_id;
            @$menus->save_menu();
        }


        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Page: {$pages->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $page->id);
    } else {
        $message = join("<br/>", $pages->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/page/titles/edit') ?>: <?php echo $page->title; ?></h2>
                <a class="btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/page/titles/manage') ?>
                    <i class="fa fa-th-list margin-right-fivePx"></i>
                </a>
               <?php if ($session->has_permission('PageTranslate')) { ?>
                    <a class="btn btn-info pull-left" href="_translate.php?parent=<?php echo $page->id; ?>"><?php echo read_xmls('/site/page/lables/translate') ?><i class="fa fa-language margin-right-fivePx"></i></a>
                <?php } ?>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="page" action="_edit.php?id=<?php echo $page->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label> <?php echo read_xmls('/site/page/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo $page->title; ?>" maxlength="255" />
                                    <?php echo read_xmls('/site/page/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/page/lables/urlalias') ?></label>
                                <input class="form-control" name="url_alias" type="text" id="url_alias" value="<?php echo $page->url_alias; ?>" onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                    <?php echo read_xmls('/site/page/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/page/lables/content') ?></label>

                                <?php
                                $getValue = $page->content;
                                $getField = 'content';
                                $getBaseFolder = '../../aids/ckeditor/';
                                $getType = 'larg';
                                include('../../aids/editor.php');
                                ?>
                            </div>
                            <?php
                            $check = Menu::count_by_sql("where type='page' and page_id=" . $page->id);
                            if ($check == 0) {
                                ?>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/menu/lables/addtomenu') ?></label>
                                    <input type="checkbox" name="add_as_menu" id="add_as_menu" value="1" onclick="showMeJQ('addasmenu_tr')"/></td>
                                </div>
                                <div class="form-group" id="addasmenu_tr" style="display: none;">
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
                                        </select>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/page/lables/module') ?></label>
                                <select  class="form-control" name="module_id">
                                    <option value="Null"><?php echo read_xmls('/site/page/lables/select'); ?></option>
                                    <?php
                                    //Get all Categories
                                    $modules = module::find_all("title ASC", " WHERE publish=1 AND site_id={$session->site_id}");
                                    foreach ($modules as $module):
                                        ?>
                                        <option value='<?php echo $module->id; ?>'<?php
                                        if ($page->module_id == $module->id) {
                                            echo ' selected';
                                        }
                                        ?>><?php echo $module->title; ?></option>
                                            <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/page/lables/keywords') ?></label>
                                <textarea class="form-control" name="keywords" cols="30" rows="5"><?php echo $page->keywords; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/page/lables/description') ?></label>
                                <textarea class="form-control" name="description" cols="30" rows="5"><?php echo $page->description; ?></textarea>
                            </div>

                            <div  class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
