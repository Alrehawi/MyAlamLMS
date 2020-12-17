<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MainCategoryEdit', '_manage.php');

if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$main = MainCategory::find_by_id($_GET['id'], " AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $mains = new MainCategory();
    @$mains->id = intval($_GET['id']);
    @$mains->title = trim($_POST['title']);
    @$mains->parent_id = $_POST['parent_id'];
    @$mains->module_id = Module::find_alias('module_main_subject.php', 'id');
    @$mains->url_alias = trim($_POST['url_alias']);
    @$mains->paging = intval(trim($_POST['paging']));
    @$mains->content = trim($_POST['content']);
    @$mains->layout = trim($_POST['layout']);
    @$mains->subject_sort = trim($_POST['subject_sort']);
    @$mains->sort_id = $main->sort_id;
    @$mains->site_id = $main->site_id;
    @$mains->publish = $main->publish;
    @$mains->lang_id = $main->lang_id;
    @$mains->created = $main->created;
    @$mains->updated = current_date();

    if ($mains->save_main($main->id)) {

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
            @$menus->main_id = $main->id;
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
            @$menus->lang_id = $main->lang_id;
            @$menus->save_menu();
        }

        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update MainCategory: {$mains->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $main->id);
    } else {
        $message = join("<br/>", $mains->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>

<script language="javascript">
    $(function () {
        $('#link').load('../../aids/getContentType.php?type=<?php echo $main->type ?>&update=<?php echo $main->id ?>');
    });
</script>

<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
            <div  class="panel-heading">
                <h2><?php echo read_xmls('/site/main/titles/edit') ?>: <?php echo $main->title; ?></h2>
                <a class=" btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/main/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>
                <?php if ($session->has_permission('MainCategoryTranslate')) { ?>
                    <a class=" btn btn-info pull-left margin-link" href="_translate.php?parent=<?php echo @$main->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?><i class="fa fa-language margin-right-fivePx" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                       <form name="assign" action="_edit.php?id=<?php echo $main->id; ?>" method="POST" enctype="multipart/form-data">
                         <?php echo setToken() ?>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/main/lables/name') ?></label>
                                    <input class="form-control" type="text" name="title" value="<?php echo $main->title; ?>" maxlength="255">
                                        <?php echo read_xmls('/site/main/lables/charnum') ?></label>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/main/lables/urlalias') ?></label>
                                    <input class="form-control" name="url_alias" type="text" id="url_alias" value="<?php echo $main->url_alias; ?>" onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                        <?php echo read_xmls('/site/gallery/lables/charnum') ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/main/lables/parent') ?></label>
                                    <select  class="form-control" name="parent_id" id="parent_id">
                                            <option value="Null">..<?php echo read_xmls('/site/main/lables/toplevel'); ?></option>
                                            <?php
                                            //Get all MainCategorys
                                            $mainParents = MainCategory::find_all("sort_id ASC", " WHERE site_id={$session->site_id}");
                                            foreach ($mainParents as $mainParent):
                                                $childrins[$mainParent->id] = array(
                                                    'id' => $mainParent->id,
                                                    'title' => $mainParent->title,
                                                    'parent_id' => $mainParent->parent_id
                                                );
                                            endforeach;
                                            echo MainCategory::generate_tree_options($childrins, NULL, "&nbsp;&nbsp;", 'options', $main->parent_id);
                                            ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/main/lables/paging') ?></label>
                                    <input class="form-control" type="text" name="paging" value="<?php echo $main->paging; ?>"  maxlength="2" onkeypress='return isNumberKey(event)'/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/main/lables/layout') ?></label>
                                    <input type="radio" name="layout" value="1" <?php if (@$main->layout == 1) echo "checked" ?> /><?php echo show_icon('list_bullets.png', read_xmls('/site/main/lables/layout')); ?>
                                        <input type="radio" name="layout" value="2" <?php if (@$main->layout == 2) echo "checked" ?>/><?php echo show_icon('grid.png', read_xmls('/site/main/lables/layout')); ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/main/lables/subjectsort') ?></label>
                                   <input type="radio" name="subject_sort" value="ASC" <?php if (@$main->subject_sort == 'ASC') echo "checked" ?> /><?php echo show_icon('asc.png', read_xmls('/site/main/lables/subjectsort')); ?>
                                    <input type="radio" name="subject_sort" value="DESC" <?php if (@$main->subject_sort == 'DESC') echo "checked" ?>/><?php echo show_icon('desc.png', read_xmls('/site/main/lables/subjectsort')); ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/main/lables/content') ?></label>
                                    <?php
                                        $getValue = $main->content;
                                        $getField = 'content';
                                        $getBaseFolder = '../../aids/ckeditor/';
                                        $getType = 'larg';
                                        include('../../aids/editor.php');
                                        ?>
                                </div>

                                <?php
                                $check = Menu::count_by_sql("where type='main' and main_id=" . $main->id);
                                if ($check == 0) {
                                    ?>
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
                                                $menus = Menu::find_all("sort_id ASC", "where menu_type=0 AND site_id={$session->site_id} ");
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
                                <?php } ?>
                                <div class="form-group">
                                  <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="btn btn-primary" />
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
