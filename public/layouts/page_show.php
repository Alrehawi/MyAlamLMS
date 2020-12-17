<?php
global $session, $layout_type_id, $database, $hide_title,$plugin_menu_stages,$showHeaderFooter;
$page_obj = Page::find_by_id($layout_type_id);
Page::increase_counter($page_obj->id);
    ?>

        <?php if (!isset($_GET['printPage'])) { ?>
            <!--<div id="print"><a href="<?php //echo search_for_flag(get_current_page(),'printPage','do') ?>" target="_blank" id="print"><?php //echo show_icon('print.gif','Print','images'); ?></a></div>-->
        <?php } ?>


<div class="section-block">

          <?php
      				if($plugin_menu_stages) {
                $mainBodyClass="three-fourth ";
      					$partClass="";
      					echo $plugin_menu_stages;
      				} else {
                $mainBodyClass="";
      					$partClass="part";
      				}
      		?>
      		<div class="<?php echo $mainBodyClass?>">

                <div class="<?php echo  $partClass;?>">
                    <div class=""><?php
                    echo Page::find_viewed_language('content', $page_obj->id, Page::$trans_key);
                    //$contentTXT =  Page::find_viewed_language('content', $page_obj->id, Page::$trans_key) ;
                    //echo replaceImagesFromTXT($contentTXT);
                    //$images = findImagesFromTXT($contentTXT);
                    //echo $images;
                    ?></div>
                </div>

            <div class="divider"></div>
            <!-- Attach Contact form-->
            <?php
            if ($page_obj->contact == 1) {
                echo include_layout_template('contacts.php');
            }
            ?>


            <!-- Attach Module-->
            <?php
            if (!empty($page_obj->module_id)) {
                $module_obj = Module::find_by_id($page_obj->module_id);
                $hide_title = 1;
                if (file_exists(FILE_PATHDSO . DSO . 'layouts' . DSO . 'modules' . DSO . $module_obj->related_class)) {
                    echo include_layout_template('modules' . DS . $module_obj->related_class);
                } else {
                    echo "Can't find file";
                }
            }
            ?>
        </div>
    </div>
