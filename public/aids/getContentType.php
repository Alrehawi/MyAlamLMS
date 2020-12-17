<?php
require_once("../../includes/initialize.php");
global $session;
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if (isset($_GET['update']) && !empty($_GET['update'])) {
        $update = intval($_GET['update']);
        $cur_menu = Menu::find_by_id($update, " AND site_id={$session->site_id}");
    }
    ?>
    <?php if ($type == 'page') { ?>
        <select  class="form-control" name="page_id">
            <?php
            $pages = Page::find_all("id ASC"," WHERE site_id={$session->site_id}");
            foreach ($pages as $page):
                ?>
                <option value='<?php echo $page->id; ?>'<?php if (!empty($update) && $cur_menu->page_id == $page->id) echo ' selected'; ?>><?php echo Page::find_viewed_language('title', intval($page->id), Page::$trans_key); ?></option>
            <?php endforeach; ?>
        </select>
    <?php } else if ($type == "main") { ?>
        <select  class="form-control" name="main_id">
            <?php
            $mains = MainCategory::find_all("id ASC"," WHERE site_id={$session->site_id}");
            foreach ($mains as $main):
                ?>
                <option value='<?php echo $main->id; ?>'<?php if (!empty($update) && $cur_menu->main_id == $main->id) echo ' selected'; ?>><?php echo MainCategory::find_viewed_language('title', intval($main->id), MainCategory::$trans_key); ?></option>
            <?php endforeach; ?>
        </select>
    <?php } else if ($type == "gallery") { ?>
        <select  class="form-control" name="gallery_id">
            <?php
            $galleries = Gallery::find_all("id ASC"," WHERE site_id={$session->site_id}");
            foreach ($galleries as $gallery):
                ?>
                <option value='<?php echo $gallery->id; ?>'<?php if (!empty($update) && $cur_menu->gallery_id == $gallery->id) echo ' selected'; ?>><?php echo Gallery::find_viewed_language('title', intval($gallery->id), Gallery::$trans_key); ?></option>
            <?php endforeach; ?>
        </select>
    <?php } else if ($type == "module") { ?>
        <select  class="form-control" name="module_id">
            <?php
            $modules = Module::find_all("id ASC", "WHERE publish=1 AND site_id={$session->site_id}");
            foreach ($modules as $module):
                ?>
                <option value='<?php echo $module->id; ?>'<?php if (!empty($update) && $cur_menu->module_id == $module->id) echo ' selected'; ?>><?php echo Module::find_viewed_language('title', intval($module->id), Module::$trans_key); ?></option>
            <?php endforeach; ?>
        </select>	
    <?php } else if ($type == "permission") { ?>
        <select  class="form-control" name="permission_id">
            <?php
            $permissions = Permission::find_all("title ASC");
            foreach ($permissions as $permission):
                ?>
                <option value='<?php echo $permission->id; ?>'<?php if (!empty($update) && $cur_menu->permission_id == $permission->id) echo ' selected'; ?>><?php echo $permission->title; ?></option>
            <?php endforeach; ?>
        </select>	
    <?php } else if ($type == "extlink") { ?>
        <input class="form-control" type="text" name="url" dir="ltr" maxlength="255" <?php if (!empty($update)) echo " value='" . $cur_menu->url . "'" ?>/>  <?php echo read_xmls('/site/menu/lables/target') ?>: 
        <select  class="form-control" name="target">
            <option value="_self"<?php if (!empty($update) && $cur_menu->target == '_self') echo ' selected'; ?>>_self</option>
            <option value="_blank"<?php if (!empty($update) && $cur_menu->target == '_blank') echo ' selected'; ?>>_blank</option>
        </select>
    <?php } else { ?>
        <select><option>-- <?php echo read_xmls('/site/menu/lables/none') ?> --</option></select>
        <?php
    }
}
?>