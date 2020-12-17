<?php require_once("../../includes/initialize.php");
global $database,$session,$Subject,$content,$To,$msg,$direction;

if(!(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'))
{
  echo "Permission denied";exit;
}
if(!empty($_FILES)){


  error_reporting(E_ERROR | E_PARSE);
  if (!empty($_FILES['file']['name'])) {



      if (strstr($_FILES['file']['type'], '/', true) == 'image') {

          $new_photo_sort_id = Photographs::count_new_sort_id();
          @$photo = new Photographs();
          @$photo->caption = $_FILES['file']['name'];
          @$photo->sort_id = $new_photo_sort_id;
          @$photo->site_id = $session->site_id;
          @$photo->parent_type = JoinRequest::$trans_key;
          @$photo->publish = 1;
          @$photo->max_width = 1200;
          @$photo->max_height = 1200;
          @$photo->max_width_thumb = 200;
          @$photo->max_height_thumb = 200;
          @$photo->attatch_file($_FILES['file']);
      } else {
          echo json_encode( array( 'success' => 0,
          'msg' => read_xmls('/site/photos/msg/notphoto')
        ) );
      }

      if ($photo->save_photo()) {
          echo log_action("Add New Photo: " . $photo->caption, "By: visitor");
          $uploaded_file = array(
            'success' => 1,
            'uploaded_file_name' => $photo->id
          );
          echo json_encode($uploaded_file);exit;
      } else {
          echo json_encode( array( 'success' => 0,
          'msg' => join("<br/>", $photo->errors)
        ) );
      }

  }


}


?>
