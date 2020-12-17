<?php require_once("../../includes/initialize.php");
global $database,$session,$Subject,$content,$To,$msg,$direction;
if(!(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'))
{
    echo "Permission denied";exit;
}

if (!empty($_POST['file_name']) && Photographs::check_file_exist($_POST['file_name'])) {
    @$photo = Photographs::find_by_id($_POST['file_name']);
    @$photo->destroy();
      echo json_encode(array( 'deleted' => 'success'));exit;
}else {
    echo json_encode(array( 'deleted' => 'failed'));exit;
}

?>
