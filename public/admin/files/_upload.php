<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('FileAdd', '_manage.php');

$user = User::find_by_id($session->user_id);

//start fetching uploaded files
$uploaded_files = array();

foreach($_FILES['file_upload']['name'] as $key=>$val){
     $filename = $_FILES['file_upload']['name'][$key];

    if(isset($filename)){
      $fileToAttach = array("name"=>$_FILES['file_upload']['name'][$key] ,
                            "type"=>$_FILES['file_upload']['type'][$key],
                            "tmp_name"=>$_FILES['file_upload']['tmp_name'][$key],
                            "error"=>$_FILES['file_upload']['error'][$key],
                            "size"=>$_FILES['file_upload']['size'][$key]
                          );

      $file = new File();
      $exts = strstr($filename, '.');
      $file->title = str_replace($exts,'',$filename);
      $file->publish = 1;
      $file->site_id = $session->site_id;
      $file->created = current_date();

      $file->attatch_file($fileToAttach);
      $errors = array_filter($file->errors);
      if (!empty($errors)) {
          echo "<div class='message'>".$filename.": ".join("<br/>", $file->errors)."</div>";
      }

      if ($file->save_File()) {
        //echo $file->id;
          $uploaded_files[] = $file->id;
          echo log_action("Add New File: {$file->title} ", "By: {$user->username}");
      }
    }
 }
?>
<div class="row">
	<div class="gallery">
		<?php
    //var_dump($uploaded_files);
		if(!empty($uploaded_files)){
			foreach($uploaded_files as $file_id){ ?>
			<ul>
				<li >
          <a href="<?php echo File::get_file(intval($file_id)) ?>" target="_blank"><?php echo "<img src='".get_relative_link().'back_images'.DS."file.png"."' />" ?></a><input dir="ltr" type="text" value="<?php echo File::get_file($file_id); ?>" style="width:250px" />
				</li>
			</ul>
		<?php }	}?>
	</div>
</div>
