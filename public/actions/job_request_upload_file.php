<?php require_once("../../includes/initialize.php");
global $database,$session,$Subject,$content,$To,$msg,$direction;

if(!(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'))
{
  echo "Permission denied";exit;
}
if(!empty($_FILES)){


  error_reporting(E_ERROR | E_PARSE);
  if (!empty($_FILES['file']['name'])) {

          $files = new File();
          @$files->title = $_FILES['file']['name'];
          @$files->attatch_file($_FILES['file']);
          @$files->publish = 1;
          @$files->site_id = $session->site_id;
          @$files->created = current_date();

          if ($files->save_File()) {
            echo log_action("Add New File: " . $files->caption, "By: visitor");
            $uploaded_file = array(
              'success' => 1,
              'uploaded_file_name' => $files->id
            );
            echo json_encode($uploaded_file);exit;
        } else {
            echo json_encode( array( 'success' => 0,
            'msg' => join("<br/>", $files->errors)
          ) );
        }

  }

}


?>
