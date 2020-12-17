<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PluginAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $user_admin = User::find_by_id($session->user_id);
    $plugins = new Plugin();
    @$plugins->title = trim($_POST['title']);
    @$plugins->has_page = trim($_POST['has_page']);
    @$plugins->related_class = trim($_POST['related_class']);
    @$plugins->related_sec = trim($_POST['related_sec']);
    if ($_POST['related_sec'] == 'adsec' && !empty($_POST['ads_section_id'])) {
        @$plugins->ads_section_id = trim($_POST['ads_section_id']);
        @$plugins->gallery_id = "Null";
        @$plugins->main_id = "Null";
    } else if ($_POST['related_sec'] == 'gallery' && !empty($_POST['gallery_id'])) {
        @$plugins->gallery_id = trim($_POST['gallery_id']);
        @$plugins->main_id = "Null";
        @$plugins->ads_section_id = "Null";
    } else if ($_POST['related_sec'] == 'mains' && !empty($_POST['main_id'])) {
        @$plugins->main_id = trim($_POST['main_id']);
        @$plugins->gallery_id = "Null";
        @$plugins->ads_section_id = "Null";
    } else {
        @$plugins->main_id = "Null";
        @$plugins->gallery_id = "Null";
        @$plugins->ads_section_id = "Null";
    }
    @$plugins->show_title = trim($_POST['show_title']);
    @$plugins->content = trim($_POST['content']);
    @$plugins->javascript = trim($_POST['javascript']);
    @$plugins->css_class = trim($_POST['css_class']);
    @$plugins->css_custom = trim($_POST['css_custom']);
    @$plugins->html_id = trim($_POST['html_id']);
    if (!empty($_POST['has_menu'])) {
        @$plugins->has_menu = trim($_POST['has_menu']);
        @$plugins->menu_id = trim($_POST['menu_id']);
        @$plugins->has_page = "Null";
        @$plugins->related_class = "Null";
        @$plugins->content = "Null";
        @$plugins->javascript = "Null";
    } else {
        @$plugins->menu_id = "Null";
    }
    @$plugins->publish = 1;
    @$plugins->site_id = $session->site_id;
    @$plugins->created = current_date();
    // get default lang ID
    $default_lang = Language::get_default_lang();
    $plugins->lang_id = $default_lang[0]->id;


    if ($plugins->save_plugin()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Plugin: {$plugins->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $plugins->errors);
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
                <h2><?php echo read_xmls('/site/plugin/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/plugin/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="plugin" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/plugin/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" />
                                <?php echo read_xmls('/site/plugin/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/plugin/lables/showtitle') ?></label>
                                <input type="checkbox" name="show_title" value="1" <?php if (@$_POST['show_title'] == 1) echo "checked" ?>/>
                            </div>
                            <div class="form-group">
                                 <label><?php echo read_xmls('/site/plugin/lables/hasmenu') ?></label>
                                <input type="checkbox" name="has_menu" value="1" <?php if (@$_POST['has_menu'] == 1) echo "checked" ?> onclick="showMe('menu')"/>
                                    <div id="menu" style="display:none;">
                                        <?php echo read_xmls('/site/plugin/lables/menu') ?><BR>
                                        <select  class="form-control" name="menu_id">
                                            <option value=""><?php echo read_xmls('/site/adminactions/select') ?></option>
                                            <?php
                                            $menus = Menu::find_all('sort_id ASC', "WHERE parent_id IS NULL AND menu_type=0 and site_id={$session->site_id}");
                                            foreach ($menus as $menu):
                                                if (Menu::has_child($menu->id)) {
                                                    ?>
                                                    <option value="<?php echo $menu->id; ?>" <?php if (@$_POST['menu_id'] == $menu->id) echo ' selected'; ?>><?php echo Menu::find_viewed_language('title', $menu->id, Menu::$trans_key) ?></option>
                                                    <?php
                                                }
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/plugin/lables/haspage') ?></label>
                                <input type="checkbox" name="has_page" value="1" <?php if (@$_POST['has_page'] == 1) echo "checked" ?> onclick="showMe('page')"/>
                                    <div id="page" style="display:none;">
                                        <?php echo read_xmls('/site/plugin/lables/relatedclass'); ?><BR>
                                        <select  class="form-control" name="related_class">
                                            <option value=""><?php echo read_xmls('/site/adminactions/select') ?></option>
                                            <?php foreach (folder_content('layouts' . DSO . 'plugins' . DSO) as $key => $value): ?>
                                                <option value="<?php echo $key; ?>" <?php if (@$_POST['related_class'] == $key) echo ' selected'; ?>><?php echo $value; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                 <label><?php echo read_xmls('/site/plugin/lables/relatedsec') ?></label>
                                <select  class="form-control" name="related_sec" onchange="showMeTblRow(this.value, 'sections')">
                                        <option value="">-- <?php echo read_xmls('/site/plugin/lables/select') ?> --</option>
                                        <option value="adsec"><?php echo read_xmls('/site/plugin/lables/adsec') ?></option>
                                        <option value="mains"><?php echo read_xmls('/site/plugin/lables/main') ?></option>
                                        <option value="gallery"><?php echo read_xmls('/site/plugin/lables/gallery') ?></option>
                                    </select>
                            </div>
                            <div class="form-group sections" id="adsec" style="display:none;">
                                <label><?php echo read_xmls('/site/plugin/lables/selectsec') ?></label>
                                <select class="form-control" name="ads_section_id">
                                        <option value="Null"><?php echo read_xmls('/site/adminactions/select') ?></option>
                                        <?php
                                        $adsecs = AdSection::find_all('id ASC', "WHERE site_id={$session->site_id}");
                                        foreach ($adsecs as $adsec):
                                            ?>
                                            <option value="<?php echo $adsec->id; ?>" <?php if (@$_POST['ads_section_id'] == $adsec->id) echo ' selected'; ?>><?php echo AdSection::find_viewed_language('title', $adsec->id, AdSection::$trans_key) ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                            </div>
                            <div class="form-group">
                                <div id="gallery" style="display:none;" class='sections'>
                                <label><?php echo read_xmls('/site/plugin/lables/selectsec') ?></label>
                                <select  class="form-control" name="gallery_id">
                                        <option value="Null"><?php echo read_xmls('/site/adminactions/select') ?></option>
                                        <?php
                                        $gallerys = Gallery::find_all('id ASC', "WHERE site_id={$session->site_id}");
                                        foreach ($gallerys as $gallery):
                                            ?>
                                            <option value="<?php echo $gallery->id; ?>" <?php if (@$_POST['gallery_id'] == $gallery->id) echo ' selected'; ?>><?php echo Gallery::find_viewed_language('title', $gallery->id, Gallery::$trans_key) ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                 <div id="mains" style="display:none;" class='sections'>
                                <label><?php echo read_xmls('/site/plugin/lables/selectsec') ?></label>
                                <select  class="form-control" name="main_id">
                                        <option value="Null"><?php echo read_xmls('/site/adminactions/select') ?></option>
                                        <?php
                                        $mains = MainCategory::find_all('id ASC', "WHERE site_id={$session->site_id}");
                                        foreach ($mains as $main):
                                            ?>
                                            <option value="<?php echo $main->id; ?>" <?php if (@$_POST['main_id'] == $main->id) echo ' selected'; ?>><?php echo MainCategory::find_viewed_language('title', $main->id, MainCategory::$trans_key) ?></option>
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                 </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/plugin/lables/cssclass') ?></label>
                                <input class="form-control" type="text" name="css_class" value="<?php echo check_var("css_class", "POST"); ?>" maxlength="255" />
                            </div>
                            <div class="form-group">
                                 <label><?php echo read_xmls('/site/plugin/lables/csscustomstyle') ?></label>
                                 <input class="form-control" type="text" name="css_custom" value="<?php echo check_var("css_custom", "POST"); ?>" maxlength="255" /> <small><i><?php echo read_xmls('/site/plugin/lables/csscustomstylebrief') ?>: float:left; width:300px; height:250px;</i></small>
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/plugin/lables/htmlid') ?></label>
                                <input class="form-control" type="text" name="html_id" value="<?php echo check_var("html_id", "POST"); ?>" maxlength="255" />
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/plugin/lables/content') ?></label>
                                <?php
                                    $getValue = @$_POST['content'];
                                    $getField = 'content';
                                    $getBaseFolder = '../../aids/ckeditor/';
                                    $getType = 'larg';
                                    include('../../aids/editor.php');
                                    ?>
                            </div>

                             <div class="form-group">
                                <label><?php echo read_xmls('/site/plugin/lables/javascript') ?></label>
                                <textarea class="form-control" name="javascript" cols="300" rows="20" dir="ltr"><?php echo @$_POST['javascript']; ?></textarea> <small><i><?php echo read_xmls('/site/plugin/lables/javascriptbrief') ?>: &nbsp; &lt;script&gt; _____&lt;/script&gt; </i></small>
                            </div>

                            <div class="form-group">
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
