<?php
global $session,$hide_title,$database, $pagination,$paging,$plugin_menu_stages;

if(!isset($_GET['gallery']) || !Gallery::count_by_field('url_alias',$_GET['gallery'])){
	redirect_to(Page::get_home_link());
}

$gallery=trim($_GET['gallery']);
$gallery_req=Gallery::find_by_field('url_alias',$database->escape_value($gallery));
$gallery_req=$gallery_req[0];
Gallery::increase_counter($gallery_req->id);
$paging = !empty($_GET['paging']) ? (int)$_GET['paging'] : 1;
$per_page = $gallery_req->paging;
$total_count = Media::count_all(" WHERE gallery_id=".$gallery_req->id." AND publish=1");
$pagination = new Pagination ($paging , $per_page , $total_count);
$medias = Media::find_all("sort_id ASC LIMIT {$per_page} OFFSET {$pagination->offset()}" , "WHERE gallery_id=".$gallery_req->id." AND publish=1");

?>




	<!-- Projects Mansory START -->
	<div class="section-block">
	  <div class="container">
	    <div class="row mt-30">
	      <div class="masonry-4">

					<?php foreach($medias as $media):
						if($media->media_type=='youtube'){$classNmae="hover_video";} else {$classNmae="hover_slideshow";}
							if($media->media_type=='image'){	?>
	        <a id="popup-media" class="portfolio-item-link" data-rel="prettyPhoto[gal]" title="<?php echo $media->title;?>" href="<?php echo $media->get_image($media->id , 'larg',$media->gallery_id);?>" >
	          <div class="masonry-item">
	            <img src="<?php echo $media->get_image($media->id , 'larg',$media->gallery_id);?>" style="width:400px" alt="project">
	            <div class="masonry-item-overlay">
	              <h4><?php //echo $media->title;?></h4>
	              <!-- <ul><li>Business</li><li>Consulting</li></ul> -->
	            </div>
	          </div>
	        </a>
				<?php } else if($media->media_type=='youtube'){
					$youtubeparam = doubleExplode('v=','&',$media->url);
					$youtubeparam=@array_shift(@array_values($youtubeparam));
					?>

					<a id="popup-media"  title="<?php echo $media->title;?>"href="http://www.youtube.com/watch?v=<?php echo $youtubeparam;?>"  data-rel="prettyPhoto[gal]">
	          <div class="masonry-item">
	            <img src="https://i.ytimg.com/vi/<?php echo $youtubeparam;?>/hq720.jpg" alt="project">
	            <div class="masonry-item-overlay">
	              <h4><?php echo $media->title;?></h4>
								<ul><li>فيديو</li></ul>
	            </div>
	          </div>
	        </a>

				<?php }?>


<?php endforeach?>


	      </div>
	    </div>
	  </div>
	</div>
	<!-- Projects Mansory END -->
		<div id="pagination" class="pagination" style="clear:both"> <?php echo include_layout_template('pagination_front.php');?> </div>
