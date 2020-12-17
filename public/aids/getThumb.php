<?php

require_once("../../includes/initialize.php");
global $session;
if (isset($_GET['thumb'])) {
    $thumb = intval($_GET['thumb']);
    $coutn_thumb = Photographs::count_by_field('id', $thumb);
    if ($coutn_thumb > 0) {
        $object = Photographs::find_by_id($thumb);
        echo "<a href='" . $object->get_image($object->id, 'larg') . "' target='_blank'><img src='" . $object->get_image($object->id, 'small') . "' border='0'></a>";
    }
}
?>