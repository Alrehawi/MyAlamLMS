<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('ModuleEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$module = Module::find_by_id($_GET['id']," AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $modules = new Module();
    @$modules->id = $_GET['id'];
    @$modules->title = trim($_POST['title']);
    @$modules->url_alias = trim($_POST['url_alias']);
    @$modules->related_class = trim($_POST['related_class']);
    @$modules->keywords = trim($_POST['keywords']);
    @$modules->description = trim($_POST['description']);
    @$modules->publish = $module->publish;
    @$modules->site_id = $module->site_id;
    @$modules->lang_id = $module->lang_id;
    @$modules->created = $module->created;
    @$modules->updated = current_date();

    if ($modules->save_module($module->id)) {

        if (@$_POST['add_as_menu'] == 1) {
            //Create menu
            if ($_POST['parent_id'] == "Null") {
                $new_sort_id = Menu::count_new_sort_id("WHERE menu_type=0 AND parent_id IS NULL AND site_id={$session->site_id}");
            } else {
                $new_sort_id = Menu::count_new_sort_id("WHERE site_id={$session->site_id} AND parent_id=" . intval($_POST['parent_id']));
            }
            $menus = new Menu();
            @$menus->title = trim($_POST['title']);
            @$menus->parent_id = $_POST['parent_id'];
            @$menus->type = 'module';
            @$menus->page_id = "Null";
            @$menus->module_id = $module->id;
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
            @$menus->lang_id = $module->lang_id;
            @$menus->save_menu();
        }


        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Module: {$modules->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $module->id);
    } else {
        $message = join("<br/>", $modules->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>
 <!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/module/titles/edit') ?> : <?php echo $module->title; ?></h2>
                <a style="color: #fff;"  class="pull-left btn btn-primary margin-link" href="_manage.php"><?php echo read_xmls('/site/module/titles/manage') ?><i class="fa fa-th-list" aria-hidden="true"></i></a>
               <?php if ($session->has_permission('ModuleTranslate')) { ?>
                    <a class="pull-left btn btn-info margin-link" href="_translate.php?parent=<?php echo $module->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?><i class="fa fa-language margin-right-fivePx" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                       <form name="module" action="_edit.php?id=<?php echo $module->id; ?>" method="POST" enctype="multipart/form-data">
                         <?php echo setToken() ?>
                            <div class="form-group">
                                 <label><?php echo read_xmls('/site/module/lables/name') ?></label>
                                <input class="form-control"  type="text" name="title" value="<?php echo $module->title; ?>" maxlength="255" />
                                    <?php echo read_xmls('/site/module/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                 <label><?php echo read_xmls('/site/module/lables/urlalias') ?></label>
                                <input class="form-control"  name="url_alias" type="text" id="url_alias" value="<?php echo $module->url_alias; ?>" onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                    <?php echo read_xmls('/site/module/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                 <label><?php echo read_xmls('/site/module/lables/relatedclass') ?></label>
                                <select  class="form-control" name="related_class">
                                        <?php foreach (folder_content('layouts' . DSO . 'modules' . DSO) as $key => $value): ?>
                                            <option value="<?php echo $key; ?>" <?php if ($module->related_class == $key) echo ' selected'; ?>><?php echo $value; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                            </div>
                            <?php
                            $check = Menu::count_by_sql("where type='module' and module_id=" . $module->id);
                            if ($check == 0) {
                                ?>
                                <div class="form-group">
                                     <label><?php echo read_xmls('/site/menu/lables/addtomenu') ?></label>
                                    <input type="checkbox" name="add_as_menu" id="add_as_menu" value="1" onclick="showMeJQ('addasmenu_tr')"/>
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
                                    </td>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/module/lables/keywords') ?></label>
                                <textarea class="form-control"  name="keywords" cols="30" rows="5"><?php echo $module->keywords; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/module/lables/description') ?></label>
                                <textarea class="form-control"  name="description" cols="30" rows="5"><?php echo $module->description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
