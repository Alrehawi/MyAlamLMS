<?php
global $layout_type, $layout_type_id,$session,$showHeaderFooter,$page_title;
//HERE WE GET THE LAYOUT
//IF LAYOUT ASSIGNED
$cur_page = Page::find_by_id($layout_type_id);

if (Layout::count_by_field($layout_type, $layout_type_id," AND site_id={$session->site_id}") > 0) {
    $layouts = Layout::find_by_field($layout_type, $layout_type_id,'ASC'," AND site_id={$session->site_id}");
    if ($layouts[0]->defaults == 2) {
        $layouts = Layout::find_by_field("defaults", 1,'ASC'," AND site_id={$session->site_id}");
    }
} else {
//ELSE GET DEFAULT LAYOUT
    $layouts = Layout::find_by_field("defaults", 1,'ASC'," AND site_id={$session->site_id}");
}
//print_r($layouts);

$layouts = $layouts[0];
$middleSide = "";
$topSide = explode(',', $layouts->top_side);
$leftSide = explode(',', $layouts->left_side);
$rightSide = explode(',', $layouts->right_side);
$bottomSide = explode(',', $layouts->bottom_side);
?>
<?php
if (@$cur_page->home != 1) {
  if($showHeaderFooter){
    ?>
      <!-- Page Title START -->
      <div class="page-title-section" style="background-image: url('./images/img/104.jpg');">
        <div class="container col-md-8">
          <h1><?php echo $page_title ?></h1>
          <ul>
            <?php echo include_layout_template('plugins' . DS . 'plugin_navigation.php'); ?>
          </ul>
        </div>
      </div>
      <!-- Page Title END -->
<?php
  }
}
?>
<?php if($showHeaderFooter){?>
  <?php if (!empty($topSide[0])) { ?>
    <!-- Start Top -->
    <div class="top_part">
        <?php echo Plugin::get_plugins($topSide); ?>
    </div>
    <!-- End Top -->
  <?php } ?>
<?php } ?>



<div class="container main-layout">
    <div class="row">
      <?php if($showHeaderFooter){?>

        <?php if (!empty($rightSide[0])) { ?>
            <!-- Start Right -->
            <?php if (!empty($leftSide[0])) { ?>
            <div class="col-sm-3 hidden-xs">
            <?php } else { ?>
            <div class="col-sm-3 hidden-xs">
            <?php } ?>
                <?php echo Plugin::get_plugins($rightSide, "right"); ?>
            </div>
            <!-- End Right -->
        <?php } ?>
        <?php } ?>
        <?php if (@$cur_page->home != 1) {?>
         <!-- Start Mclassdle -->
        <?php if (!empty($rightSide[0]) && !empty($leftSide[0])) { ?>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <?php } else if (empty($rightSide[0]) && empty($leftSide[0])) { ?>
        <div class="col-sm-12 col-xs-12">
        <?php } else { ?>
        <div class="col-sm-9 col-xs-12">
        <?php } ?>
            <?php
            if ($layout_type == "page_id") {
                echo include_layout_template('page_show.php');
            } else if ($layout_type == "module_id") {
                $module_obj = Module::find_by_id($layout_type_id);
                if (file_exists(FILE_PATHDSO . DSO . 'layouts' . DSO . 'modules' . DSO . $module_obj->related_class)) {
                    echo include_layout_template('modules' . DS . $module_obj->related_class);
                    //echo FILE_PATHDSO.DSO.'layouts'.DSO.'modules'.DSO.$module_obj->related_class;
                }
            }
            ?>
        </div>
      <?php }?>
      <?php if($showHeaderFooter){?>
        <?php if (!empty($leftSide[0])) { ?>
            <!-- Start Left -->
            <?php if (!empty($rightSide[0]) && @$cur_page->home != 1) { ?>
            <div class="col-sm-3 col-xs-12">
            <?php } else if (!empty($rightSide[0]) && @$cur_page->home == 1) { ?>
            <div class="col-sm-9 col-xs-12">
            <?php } else { ?>
            <div class="col-md-3 col-sm-3 col-xs-12">
            <?php } ?>
                <?php echo Plugin::get_plugins($leftSide, "left"); ?>
            </div>
            <!-- End Left -->
          <?php } ?>

      <?php } ?>

    </div>
    <!-- End Mclassdle -->
</div>
<?php if($showHeaderFooter){?>
<?php if (!empty($bottomSide[0])) { ?>
    <!-- Start Bottom -->
    <div class="bottom">
        <?php echo Plugin::get_plugins($bottomSide); ?>
    </div>
    <!-- End Bottom -->
  <?php }?>
<?php }?>
