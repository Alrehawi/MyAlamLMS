<?php require_once("../includes/initialize.php"); ?>
<?php

global $database, $session;
if (isset($_GET['submit'])) {
    if (empty($_GET['search'])) {
        echo "<span class='red'>" . read_xmls('/site/msg/allrequire') . "</span>";
    } else {
        $search = trim($database->escape_value($_GET['search']));
        $parts = preg_split("/[\s,]+/", $search);

        if (isset($search) && (strlen($search) > 50 || strlen($search) < 3)) {
            echo "<span class='red'>" . read_xmls('/site/frontend/msg/searchlimit') . "</span>";
        } else {
            foreach ($parts as $part) {
                //pages
                $clauses[] = "page_title LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "keywords LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "description LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "part_title LIKE '%" . $database->escape_value($part) . "%'";
                $clauses[] = "part_content LIKE '%" . $database->escape_value($part) . "%'";
                //module
                $clauses_mods[] = "title LIKE '%" . $database->escape_value($part) . "%'";
                $clauses_mods[] = "keywords LIKE '%" . $database->escape_value($part) . "%'";
                $clauses_mods[] = "description LIKE '%" . $database->escape_value($part) . "%'";
                //Translate
                $clauses_trans[] = "content LIKE '%" . $database->escape_value($part) . "%'";
                //menu
                $clauses_menu[] = "title LIKE '%" . $database->escape_value($part) . "%'";
            }

            $clause = implode(' OR ', $clauses);
            $clauses_mod = implode(' OR ', $clauses_mods);
            $clause_trans = implode(' OR ', $clauses_trans);
            $clause_menu = implode(' OR ', $clauses_menu);

            $sql = "SELECT DISTINCT `page_id`
                        ,`page_title`
                        ,`description`
                         FROM 	`search_pages` 
                         WHERE  ({$clause})
                    UNION
                    SELECT DISTINCT `id`
                        ,`title`
                        ,'modules'
                        FROM `modules`
                        WHERE  ({$clauses_mod}) 
                        AND publish=1 
                    UNION
                    SELECT DISTINCT `id`
                        ,`title`
                        ,'menus'
                        FROM `menus`
                        WHERE ({$clause_menu}) 
                        AND publish=1 

                    UNION
                    SELECT DISTINCT `parent_id`
                        ,`content`
                        ,'pages'
                        FROM `translator` 
                        WHERE ({$clause_trans}) 
                        AND (field_type='title' OR field_type='content') 
                        AND (item_type='page')
                    UNION
                    SELECT DISTINCT `parent_id`
                        ,`content`
                        ,'modules'
                        FROM `translator` 
                        WHERE ({$clause_trans}) 
                        AND (field_type='title' OR field_type='content') 
                        AND item_type='module'

                    ORDER BY page_title ASC
                    ";
        /*
              UNION
              SELECT DISTINCT `parent_id`
              ,`content`
              ,'menus'
              FROM `translator`
              WHERE ({$clause_trans})
              AND (field_type='title' OR field_type='content')
              AND item_type='menu'

             */
            //echo $sql;
            $results = $database->query($sql);
            if (!$database->num_rows($results)) {
                echo "<span class='red'>" . read_xmls('/site/frontend/msg/noresult') . "</span>: " . stripslashes($search);
            } else {

                echo "<div class='searchbox'>";
                //echo "<h2>".read_xmls('/site/frontend/search/result')."</h2>";	
                $search_result = Search::find_by_sql($sql);
                //echo $sql."<br />";
                foreach ($search_result as $sr):
                    if (intval($sr->page_id))
                        $param = 'page';
                    else
                        $param = 'module';
                    echo $sr->get_results($sr->page_id, $sr->description, $sr->page_title);
                endforeach;
                echo "</div>";
            }
        }
    }
}
?>