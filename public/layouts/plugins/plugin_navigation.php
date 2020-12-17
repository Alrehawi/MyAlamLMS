<?php
global $page_title;
//$dividerImg = show_icon($icon = 'nav_' . read_xmls('/site/config/otheralign') . '.png', $title = '', $folder = "images" . DS . "img") . " &nbsp;";
$dividerImg = "";
$type = get_current_page_type();
$alias = $_GET[$type];
@$checkmenu4page = Menu::checkmenu($type, $alias);

if ($checkmenu4page) {
    //if link exists on menu get parents
    $parents = Menu::get_patents($checkmenu4page);
    array_push($parents, $checkmenu4page);
    $menuTitles = array();
    foreach ($parents as $parent):
      if($parent != 331){
        $titleOfMenu = limit_words(Menu::find_viewed_language('title', $parent, Menu::$trans_key), 3);
        if ($parent == end($parents)) {
            $menuTitles[] = "<li><a href='#'>".$titleOfMenu."</a></li>";
        } else {

            $menuTitles[] = "<li><a " . Menu::generate_link($parent) . ">" . $titleOfMenu . "</a></li>";
        }
      }
    endforeach;
    $footPrint = join($dividerImg, $menuTitles);
} else {
    // else
    if ($type == "page") {
        //get page name only
        $footPrint = limit_words($page_title, 3) . "..";
    } else if ($type == "module") {
        //get current mpdule location and get parents
        $module_title = "<li><a href='#'>".limit_words($page_title, 3) . ".."."</a></li>";
        $module_id = Module::find_object_id($type, $alias);
        $module = Module::find_by_id($module_id);

        //check main subject and subject object
        if ($module->related_class == 'module_main_subject.php') {
            if (isset($_GET['subject'])) {
				if (!Subject::count_by_field('url_alias', $_GET['subject'])) redirect_to('error.php');
                $mainCat4Sub = Subject::find_by_field('url_alias', @$_GET['subject'], 'ASC', " AND publish=1 ");
                $parents = MainCategory::get_patents($mainCat4Sub[0]->main_id);
                array_push($parents, $mainCat4Sub[0]->main_id);

                $subTitles = array();
                $subTitles[] = "<li class='current'><a class='crumbs-home' href='./?module=" . $module->url_alias . "'>" . Module::find_viewed_language('title', $module_id, Module::$trans_key) . "</a></li>";
                foreach ($parents as $parent):
                  $mainSubject = MainCategory::find_by_id($parent);
                    $titleOfMenu = limit_words(MainCategory::find_viewed_language('title', $parent, MainCategory::$trans_key), 3) . "..";
                    $subTitles[] = "<li><a href='./?module=" . $module->url_alias . "&main_subject=" . $mainSubject->url_alias . "'>" . $titleOfMenu . "</a></li>";
                endforeach;
                $subTitles[] = $module_title;
                $footPrint = join($dividerImg, $subTitles);
            } else if (isset($_GET['main_subject'])) {
				if (!MainCategory::count_by_field('url_alias', $_GET['main_subject'])) redirect_to('error.php');
                $mainCat = MainCategory::find_by_field('url_alias', @$_GET['main_subject'], 'ASC', " AND publish=1 ");
                $parents = MainCategory::get_patents($mainCat[0]->id);
                array_push($parents, $mainCat[0]->id);
                $subTitles = array();
                $subTitles[] = "<li class='current'><a class='crumbs-home' href='./?module=" . $module->url_alias . "'>" . Module::find_viewed_language('title', $module_id, Module::$trans_key) . "</a></li>";
                foreach ($parents as $parent):
                    $titleOfMenu = limit_words(MainCategory::find_viewed_language('title', $parent, MainCategory::$trans_key), 3) . "..";
                    if ($parent == end($parents)) {
                        $subTitles[] = "<li><a href='#'>".$titleOfMenu."</a></li>";
                    } else {
                        $subTitles[] = "<li class='current'><a class='crumbs-home' href='./?module=" . $module->url_alias . "&main_subject=" . $_GET['main_subject'] . "'>" . $titleOfMenu . "</a></li>";
                    }
                endforeach;
                $footPrint = join($dividerImg, $subTitles);
            } else {
                $footPrint = $module_title;
            }
            //check gallery object
        } else if ($module->related_class == 'module_gallery.php') {
            if (isset($_GET['gallery'])) {

                if (!Gallery::count_by_field('url_alias', $_GET['gallery'])) redirect_to('error.php');
                $mainGallery = Gallery::find_by_field('url_alias', $_GET['gallery'], 'ASC', " AND publish=1 ");
                $subTitles = array();
                $subTitles[] = "<li class='current'><a class='crumbs-home' href='./?module=" . $module->url_alias . "'>" . Module::find_viewed_language('title', $module_id, Module::$trans_key) . "</a></li>";
                $subTitles[] = "<li class='current'><a class='crumbs-home' href='#'>".limit_words(Gallery::find_viewed_language('title', $mainGallery[0]->id, Gallery::$trans_key), 3) . "..</a></li>";

                $footPrint = join($dividerImg, $subTitles);

            } else {
                $footPrint = $module_title;
            }
        } else {
            $footPrint = $module_title;
        }
    }
}
?>
<?php
if(!Page::check_home($alias)){
?>

    <li class="current"><a class='crumbs-home' href="./"><?php echo read_xmls('/site/frontend/home/homelabel') ?></a></li>
        <?php
        if (!empty($footPrint)) {
            echo $dividerImg;
            echo $footPrint;
        }
        ?>

<?php }?>
