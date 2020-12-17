<?php

global $pagination, $paging;
if (!intval($paging)) {
    redirect_to('./');
}

// pagination navigation
if ($pagination->total_pages() > 1) {

    if ($pagination->has_previous_page()) {
        echo "<li><a href=\"" . search_for_flag(get_current_page(), 'paging', $pagination->previous_page()) . "\" class='btn btn-primary'> &laquo; " . read_xmls('/site/paging/prev') . "</a></li>";
    }

    for ($i = 1; $i <= $pagination->total_pages(); $i++) {
        if ($i == $paging) {
            echo " <li class=\"active\"><a >{$i}</a></li>";
        } else {
            echo " <li><a href=\"" . search_for_flag(get_current_page(), 'paging', $i) . "\" class='btn btn-primary'>{$i}</a></li>  ";
        }
    }

    if ($pagination->has_next_page()) {
        echo " <li><a href=\"" . search_for_flag(get_current_page(), 'paging', $pagination->next_page()) . "\" class='btn btn-primary'>" . read_xmls('/site/paging/next') . " &raquo;</a></li>";
    }
}
?>
