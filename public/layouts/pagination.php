<?php

global $pagination, $page;
// pagination navigation 
if ($pagination->total_pages() > 1) {

    if ($pagination->has_previous_page()) {
        echo "<a href=\"" . search_for_flag(get_current_page(), 'page', $pagination->previous_page()) . "\" class='paging'> &laquo; " . read_xmls('/site/paging/prev') . "</a> ";
    }

    for ($i = 1; $i <= $pagination->total_pages(); $i++) {
        if ($i == $page) {
            echo " <span class=\"paging_cur\">{$i}</span>";
        } else {
            echo " <a href=\"" . search_for_flag(get_current_page(), 'page', $i) . "\" class='paging'>{$i}</a>  ";
        }
    }

    if ($pagination->has_next_page()) {
        echo " <a href=\"" . search_for_flag(get_current_page(), 'page', $pagination->next_page()) . "\" class='paging'>" . read_xmls('/site/paging/next') . " &raquo;</a>";
    }
}
?>