<?php
require_once('../../../includes/initialize.php');
global $database;
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('LayoutView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<script type="text/javascript">
    var boxSizeArray = [6, 6, 6, 6];
    var verticalSpaceBetweenListItems = 3;
    var indicateDestionationByUseOfArrow = false;
    var cloneSourceItems = false;
    var cloneAllowDuplicates = false;

    /* END VARIABLES YOU COULD MODIFY */
    var dragDropTopContainer = false;
    var dragTimer = -1;
    var dragContentObj = false;
    var contentToBeDragged = false;
    var contentToBeDragged_src = false;
    var contentToBeDragged_next = false;
    var destinationObj = false;
    var dragDropIndicator = false;
    var ulPositionArray = new Array();
    var mouseoverObj = false;

    var MSIE = navigator.userAgent.indexOf('MSIE') >= 0 ? true : false;
    var navigatorVersion = navigator.appVersion.replace(/.*?MSIE (\d\.\d).*/g, '$1') / 1;

    var arrow_offsetX = -5;
    var arrow_offsetY = 0;

    if (!MSIE || navigatorVersion > 6) {
        arrow_offsetX = -6;
        arrow_offsetY = -13;
    }

    var indicateDestinationBox = false;

    function validate() {
        with (layout) {
            if (document.layout.page_id.value == '0' && document.layout.module_id.value == '0' && document.layout.defaults.value == '0') {
                alert('<?php echo read_xmls('/site/layout/validation/pageormodule') ?>');
                document.assign.page_id.focus();
                return false;
            }
        }
    }
</script>
<?php echo get_js('layout.js'); ?>
<script type="text/javascript">window.onload = initDragDropScript;</script>
<?php
/* if(@$_POST['save']){
  $nodes = Layout::doubleExplode('|',';',$_POST['layout_values']);
  //echo implode(",",$nodes['top']);
  echo var_dump($_POST)."<br /><br />";

  echo "<pre>";
  print_r($nodes);
  echo "</pre>";
  exit;
  } */
if(!isset($_GET['defaults']) && empty($_GET['page_id']) && empty($_GET['module_id'])){
  redirect_to("./?defaults=do");
}
$cur_page_id = @intval($_GET['page_id']);
$cur_module_id = @intval($_GET['module_id']);
if (@$_GET['defaults'] == "do") {
    $defaults = 1;
    $classActive="active";
} else {
    $defaults = 0;
    $classActive="";
}

$cond = "";
$qstring = "";
if (!empty($cur_page_id)) {
    $qstring = "page_id=" . $cur_page_id;
    $cond = "WHERE page_id=" . $database->escape_value($cur_page_id);
}
if (!empty($cur_module_id)) {
    $qstring = "module_id=" . $cur_module_id;
    $cond = "WHERE module_id=" . $database->escape_value($cur_module_id);
}
if (!empty($defaults)) {
    $qstring = "defaults=do";
    $cond = "WHERE defaults=" . $database->escape_value($defaults);
}
$layout = Layout::find_all('id ASC', $cond." AND site_id={$session->site_id} ");
$layout = @$layout[0];
$count_all = Layout::count_all( $cond." AND site_id={$session->site_id} ");
//echo $cond."<br />".$count_all."<br />".$layout->id;exit;
$user_admin = User::find_by_id($session->user_id);

if (check_var("save", "POST")) {
    $nodes = Layout::doubleExplode('|', ';', $_POST['layout_values']);
    $layouts = new Layout();
    if ($count_all > 0) {
        @$layouts->id = $layout->id;
    }
    if (empty($_POST['page_id']))
        @$layouts->page_id = "Null";
    else
        @$layouts->page_id = intval($_POST['page_id']);
    if (empty($_POST['module_id']))
        @$layouts->module_id = "Null";
    else
        @$layouts->module_id = intval($_POST['module_id']);
    if (empty($_POST['defaults']))
        @$layouts->defaults = "Null";
    else
        @$layouts->defaults = intval($_POST['defaults']);
    if (!($_POST['defaults'])) {
        if (isset($_POST['make_default'])) {
            @$layouts->defaults = intval($_POST['make_default']);
        } else {
            @$layouts->defaults = "Null";
        }
    }
    @$layouts->top_side = implode(",", $nodes['top']);
    @$layouts->left_side = implode(",", $nodes['left']);
    @$layouts->right_side = implode(",", $nodes['right']);
    @$layouts->bottom_side = implode(",", $nodes['bottom']);
    @$layouts->updated = current_date();
    @$layouts->site_id = $session->site_id;

    if ($count_all < 1) {
        //add new record
        if ($layouts->save()) {
            $session->message(read_xmls('/site/msg/sucupdate'));
            echo log_action("Add Layout: {$layouts->updated} ", "By: {$user_admin->username}");
            redirect_to("./?" . $qstring);
        } else {
            $message = join("<br/>", $layouts->errors);
        }
    } else {
        //update new record
        if ($layouts->save($layout->id)) {
            $session->message(read_xmls('/site/msg/sucupdate'));
            echo log_action("Update Layout: {$layouts->updated} ", "By: {$user_admin->username}");
            redirect_to("./?" . $qstring);
        } else {
            $message = join("<br/>", $layouts->errors);
        }
    }
}
?>

<?php
if (!empty($cur_page_id)) {
    $layout_content = Layout::find_by_field('page_id', $cur_page_id,'ASC'," AND site_id={$session->site_id}");
} else if (!empty($cur_module_id)) {
    $layout_content = Layout::find_by_field('module_id', $cur_module_id,'ASC'," AND site_id={$session->site_id}");
} else if (!empty($defaults)) {
    $layout_content = Layout::find_by_field('defaults', $defaults,'ASC'," AND site_id={$session->site_id}");
}
$layout_content = @$layout_content[0];
?>

  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/layout/titles/manage') ?></h2>
                <span class="pull-left" style="position: relative;top: -11px;">
                <?php if ($layout_content) echo "<br />" . read_xmls('/site/adminactions/updated') . ': <span class="date">' . make_event_show_last($layout_content->updated) . "</span>"; ?>
                </span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <center>
                    <form class="layout-form" name="assign" action="<?php echo get_current_page(); ?>" method="POST">
                        <div class="form-group">



                            <select class="select" name="page_id" onChange="get_dropdown_id_multi('<?php echo search_for_flag("./", 'page_id', ''); ?>', 'page_id')">
                                <option value=""><?php echo read_xmls('/site/layout/lables/page') ?></option>
                                    <?php
                                    $pages = Page::find_all('id ASC'," WHERE site_id={$session->site_id}");
                                    foreach ($pages as $page):
                                        ?>
                                    <option value='<?php echo $page->id; ?>'<?php if ($cur_page_id == $page->id) echo ' selected'; ?>><?php echo Page::find_viewed_language('title', intval($page->id), Page::$trans_key); ?></option>
                                    <?php endforeach; ?>
                            </select>

                            <select  class="select" name="module_id" onChange="get_dropdown_id_multi('<?php echo search_for_flag("./", 'module_id', ''); ?>', 'module_id')">
                                <option value=""><?php echo read_xmls('/site/layout/lables/module') ?></option>
                                    <?php
                                    $modules = Module::find_all("id ASC", "WHERE publish=1 and site_id={$session->site_id}");
                                    foreach ($modules as $module):
                                        ?>
                                    <option value='<?php echo $module->id; ?>'<?php if ($cur_module_id == $module->id) echo ' selected'; ?>><?php echo Module::find_viewed_language('title', intval($module->id), Module::$trans_key); ?></option>
                           <?php endforeach; ?>
                            </select>

                            <input  class="btn btn-default <?php echo $classActive?>" style=" width: 220px;" type="button" value="<?php echo read_xmls('/site/layout/lables/defaults') ?>" onclick="location.href = './?defaults=do';"/>
                  

                        </div>
                    </form>
                </center><br>
                </div>
                <div class="row">
                    <div id="dhtmlgoodies_dragDropContainer">
                        <div id="dhtmlgoodies_listOfItems">
                            <ul id="plugins" class="plugin_cont text-center">
                                <center>
                                    <?php
                                    //echo Layout::perventedPlugins($layout->id);
                                    $icount = 0;
                                    if (!$cur_module_id && !$cur_page_id && !$defaults) {
                                        $plugins = Plugin::find_all("id ASC", "WHERE publish=1 and site_id={$session->site_id}");
                                    } else {
                                        $plugins = Plugin::find_all("id ASC", "WHERE site_id={$session->site_id} and publish=1" . @Layout::perventedPlugins($layout->id));
                                    }
                                    foreach ($plugins as $plugin):
                                        $icount++;
                                        ?>
                                    <li id="<?php echo $plugin->id ?>"><?php echo Plugin::find_viewed_language('title', $plugin->id, Plugin::$trans_key) ?></li>
                                <?php endforeach; ?>
                                </center>
                            </ul>
                        </div>
                        <div id="dhtmlgoodies_mainContainer">
                            <!-- ONE <UL> for each "room" -->
                            <div id="topDIV" class="">
                                <ul id="top">
                                    <?php
                                    if (!empty($layout_content->top_side)) {
                                        echo @Layout::find_layout_in(explode(",", $layout_content->top_side));
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div id="leftDIV">
                                <ul id="left">
                                    <?php
                                    if (!empty($layout_content->left_side)) {
                                        echo @Layout::find_layout_in(explode(",", $layout_content->left_side));
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div id="main-position"></div>
                            <div id="rightDIV">
                                <ul id="right">
                                    <?php
                                    if (!empty($layout_content->right_side)) {
                                        echo @Layout::find_layout_in(explode(",", $layout_content->right_side));
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div id="bottomDIV">
                                <ul id="bottom">
                                    <?php
                                    if (!empty($layout_content->bottom_side)) {
                                        echo @Layout::find_layout_in(explode(",", $layout_content->bottom_side));
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="dragDropIndicator"><?php echo show_icon('arrow.png', ''); ?></div>
                    <ul id="dragContent">
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="footer_layout">
                            <form action="<?php echo get_current_page(); ?>" method="POST" name="layout" onSubmit="return validate();">
                                <input type="hidden" name="page_id" value="<?php echo @$cur_page_id; ?>" />
                                <input type="hidden" name="module_id" value="<?php echo @$cur_module_id; ?>" />
                                <input type="hidden" name="defaults" value="<?php echo @$defaults; ?>" />
                                <?php if (!empty($cur_page_id) || !empty($cur_module_id)) { ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <label class="btn btn-default" style="float:<?php echo read_xmls('/site/config/align') ?>"><?php echo read_xmls('/site/layout/lables/makedefault') ?><input style="margin-right: 10px;" type="checkbox" name="make_default" value="2"<?php if (@$layout_content->defaults == 2) echo "checked='checked'"; ?>/></label><br /><br /><br />

                                <?php } ?>

                                <?php if ($session->has_permission('LayoutSave')) { ?>
                                    <div id="saveContent">
                                        <input class="btn btn-success" type="button" onclick="saveDragDropNodes('<?php echo read_xmls('/site/layout/titles/apply') ?>', '<?php echo read_xmls('/site/layout/titles/save') ?>')" value="<?php echo read_xmls('/site/layout/titles/apply') ?>" style="width:70px;">
                                        <input class="btn btn-primary" type="button" value="<?php echo read_xmls('/site/layout/titles/save') ?>" disabled="disabled" style="width:70px;">
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
