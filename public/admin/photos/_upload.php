<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PhotoAdd', '_manage.php?photo_sec=admin');
$user = User::find_by_id($session->user_id);

//start fetching uploaded photos
$uploaded_images = array();

foreach($_FILES['file_upload']['name'] as $key=>$val){
     $filename = $_FILES['file_upload']['name'][$key];

    if(isset($filename)){
      $new_sort_id = Photographs::count_new_sort_id(" WHERE site_id={$session->site_id} ");
      $fileToAttach = array("name"=>$_FILES['file_upload']['name'][$key] ,
                            "type"=>$_FILES['file_upload']['type'][$key],
                            "tmp_name"=>$_FILES['file_upload']['tmp_name'][$key],
                            "error"=>$_FILES['file_upload']['error'][$key],
                            "size"=>$_FILES['file_upload']['size'][$key]
                          );


      $photo = new Photographs();
      $exts = strstr($filename, '.');
      $photo->caption = str_replace($exts,'',$filename);
      $photo->sort_id = $new_sort_id;
      $photo->publish = 1;
      $photo->site_id = $session->site_id;
      $photo->parent_type = 'admin';

      //photo dimensions
      if (@$_POST['image_width'] && intval($_POST['image_width']) > 50) {
          $photo->max_width = intval($_POST['image_width']);
      } else {
          $photo->max_width = 1024;
      }
      if (@$_POST['image_height'] && intval($_POST['image_height']) > 50) {
          $photo->max_height = intval($_POST['image_height']);
      } else {
          $photo->max_height = 1600;
      }
      if (@$_POST['thumb_width'] && intval($_POST['thumb_width']) > 49) {
          $photo->max_width_thumb = intval($_POST['thumb_width']);
      } else {
          $photo->max_width_thumb = 100;
      }
      if (@$_POST['thumb_height'] && intval($_POST['thumb_height']) > 49) {
          $photo->max_height_thumb = intval($_POST['thumb_height']);
      } else {
          $photo->max_height_thumb = 100;
      }

      $photo->attatch_file($fileToAttach);
      $errors = array_filter($photo->errors);
      if (!empty($errors)) {
          echo "<div class='message'>".$filename.": ".join("<br/>", $photo->errors)."</div>";
      }

      if ($photo->save_photo()) {
          $uploaded_images[] = $photo->id;
          //$session->message("File Uploaded Successfully.");
          echo log_action("Add New Photo: {$photo->caption}", "By: {$user->username}");
          //redirect_to("_manage.php?photo_sec=admin");
      }
    }
 }
?>
<div class="row">
	<div class="gallery">
		<?php
		if(!empty($uploaded_images)){
			foreach($uploaded_images as $image_id){ ?>
			<ul>
				<li >
					<img src="<?php echo $photo->get_image($image_id, 'small'); ?>" hieght="100">
				</li>
			</ul>
		<?php }	}?>
	</div>
</div>
