<?php
require_once("../includes/initialize.php");
global $session, $database, $pagination, $paging;

if (isset($_GET['submit'])) {

    if (empty($_GET['search'])) {
        echo "<span class='red'>" . read_xmls('/site/msg/allrequire') . "</span>";
    } else {
        $search = trim($database->escape_value($_GET['search']));
        echo log_action("Search: {$search} " , "By: Visitor");
        $parts = preg_split("/[\s,]+/", $search);

        if (isset($search) && (strlen($search) > 200 || strlen($search) < 3)) {
            echo "<span class='red'>" . read_xmls('/site/frontend/msg/searchlimit') . "</span>";
        } else {
            foreach ($parts as $part) {
                //seach view
                $clauses[] = "title LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "keywords LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "description LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "content LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "trans_title LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "trans_content LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "trans_keywords LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "trans_description LIKE '%" . $database->escape_value($part) . "%'";
            }

            $clause = implode(' OR ', $clauses);


            $paging = !empty($_GET['paging']) ? (int) $_GET['paging'] : 1;
            if (SiteConfig::site_config('paging'))
                $per_page = SiteConfig::site_config('paging');
            else
                $per_page = 15;

            $sql = "SELECT * FROM `search_view` WHERE  ({$clause}) AND site_id={$session->site_id} GROUP BY title";
            $total_count = Search::count_by_sql_stat($sql);
            $pagination = new Pagination($paging, $per_page, $total_count);

            $sql .= " LIMIT {$per_page} OFFSET {$pagination->offset()} ";
            //echo $sql;
            $results = $database->query($sql);
            if (!$database->num_rows($results)) {
                echo "<span class='red'>" . read_xmls('/site/frontend/msg/noresult') . "</span>: " . stripslashes($search);
            } else {

                echo "<div class='searchbox col-md-12 col-sm-12 col-12'>";
                //echo "<h2>".read_xmls('/site/frontend/search/result')."</h2>";
                $search_result = Search::find_by_sql($sql);
                foreach ($search_result as $sr):
                    $lang_alias = Language::find_field_by_id('alias', $sr->lang_id);
                    if ($sr->item_type == 'menu') {
                        $url = Menu::generate_pure_link($sr->id);
                    } else if ($sr->item_type == 'media') {
                        $media = Media::find_by_id($sr->id);
                        if ($media->media_type == "image") {
                            $url = Media::get_image($media->id, 'large');
                        } else if ($media->media_type == "youtube") {
                            $url = $media->url;
                        } else {
                            $url = "";
                        }
                    } else if ($sr->item_type == "page") {
                        $url = get_relative_link() . "?page={$sr->url_alias}";
                    } else if ($sr->item_type == "module") {
                        $url = get_relative_link() . "?module={$sr->url_alias}";
                    } else if ($sr->item_type == "main") {
                        $url = get_relative_link() . "?module=" . Module::find_alias('module_main_subject.php') . "&main_subject={$sr->url_alias}";
                    } else if ($sr->item_type == "gallery") {
                        $url = get_relative_link() . "?module=" . Module::find_alias('module_gallery.php') . "&gallery={$sr->url_alias}";
                    } else if ($sr->item_type == "subject") {
                        $main_id = Subject::find_field_by_id('main_id', $sr->id);
                        $main_url_alias = MainCategory::find_field_by_id('url_alias', $main_id);
                        $url = get_relative_link() . "?module=" . Module::find_alias('module_main_subject.php') . "&main_subject={$main_url_alias}&subject={$sr->url_alias}";
                    }


                    if ($session->alias == $lang_alias) {
                        echo $sr->get_results($sr->title, $sr->description, $url);
                    } else {
                        echo $sr->get_results($sr->trans_title, $sr->trans_description, $url);
                    }
                endforeach;
                echo "</div>";
            }
        }
    }
}
?>
<!-- Pagination -->
<div class="pagination col-md-3 col-sm-6 col-12">
    <ul>
        <?php echo include_layout_template('pagination_front.php'); ?>
    </ul>
    <div class="clearfix">
    </div>
</div>
<!-- End pagination -->
