<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MediaAdd', '_manage.php');

$gallery_id = intval($_GET['gallery_id']);
$gallery = Gallery::find_by_id($gallery_id, " and  site_id={$session->site_id}");

$new_sort_id = Media::count_new_sort_id(" WHERE gallery_id=" . $gallery->id);
$default_lang = Language::get_default_lang();

//start fetching uploaded files
$uploaded_files = array();

foreach($_FILES['file_upload']['name'] as $key=>$val){

     $filename = $val;

  if(isset($filename)){
    $fileToAttach = array("name"=>$_FILES['file_upload']['name'][$key] ,
                          "type"=>$_FILES['file_upload']['type'][$key],
                          "tmp_name"=>$_FILES['file_upload']['tmp_name'][$key],
                          "error"=>$_FILES['file_upload']['error'][$key],
                          "size"=>$_FILES['file_upload']['size'][$key]
                        );

    //var_dump($_FILES);exit;
    $media = new Media();
    $file_type_media = strstr($fileToAttach['type'], '/', true);
    //echo $file_type_media;
    $media->title = strstr(basename($fileToAttach['name']), '.', true);
    $media->gallery_id = $gallery->id;
    $media->media_type = $file_type_media;
    $media->lang_id = $default_lang[0]->id;
    $media->sort_id = $new_sort_id;
    $media->publish = 1;
    $media->created = current_date();

    if ($media->media_type == 'video' || $media->media_type == 'audio') {

        $files = new File();
        @$files->title = $media->title;
        @$files->publish = 1;
        @$files->site_id = $session->site_id;
        @$files->created = current_date();
        @$files->attatch_file($fileToAttach);

        if ($files->save_File()) {
          $media->file_id = @$files->id;

          if ($media->save_videos()) {
            $uploaded_files[] = array($files->id,$file_type_media);
          } else {
              echo "<div class='message'>".$filename.": ". read_xmls('/site/msg/notfile')."</div>";
          }
        }
    } else if ($file_type_media == 'image') {

    //media dimensions
        $media->max_width = $gallery->image_width;
        $media->max_height = $gallery->image_height;
        $media->max_width_thumb = $gallery->thumb_width;
        $media->max_height_thumb = $gallery->thumb_height;

        $media->upload_dir = $gallery->folder;
        $media->upload_dir_thumb = $gallery->folder . '_thumb';
        $media->file_id = 'Null';
        $media->attatch_file($fileToAttach);

        if ($media->save_media()) {
            $uploaded_files[] =  array($media->id, $file_type_media);
        } else {
              echo "<div class='message'>".$filename.": "." ". read_xmls('/site/msg/notfile')."</div>";
        }
    } else {
      echo "<div class='message'>".$filename.": ". read_xmls('/site/msg/notfile')."</div>";
    }
  }
}
?>
<div class="row">
	<div class="gallery">
    <ul>
		<?php
    //var_dump($uploaded_files);
		if(!empty($uploaded_files)){
			foreach($uploaded_files as $file){
        if($file[1]=='image'){
      ?>
      <li >
        <img src="<?php echo $media->get_image($file[0], 'small',$media->gallery_id); ?>" hieght="100">
      </li>
    <?php } else {?>
				<li >
          <a href="<?php echo File::get_file(intval($file[0])) ?>" target="_blank"><?php echo "<img src='".get_relative_link().'back_images'.DS."file.png"."' />" ?></a><input dir="ltr" type="text" value="<?php echo File::get_file($file[0]); ?>" style="width:250px" />
				</li>
		<?php
       }
      }
    }
    ?>
    </ul>
	</div>
</div>
