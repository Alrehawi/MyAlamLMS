<?php
global $session, $sec_id;
if (empty($sec_id)) {
    echo read_xmls("/site/msg/pluginnosec");
} else {
    $ads = Ad::find_by_adsec($sec_id, ' ORDER BY sort_id ASC');
?>
<!-- Contact Boxes START -->
<div class="section-block-grey">
	<div class="container">
		<div class="row">
      <?php
      foreach ($ads as $ad):
      ?>
			<div class="col-md-3 col-sm-6 col-12">
				<div class="contact-box">
          <!-- <h4><?php //echo Ad::find_viewed_language('title', $ad->id, 'ad') ?></h4> -->
          <a href="<?php echo $ad->url; ?>" target="<?php echo $ad->target; ?>">
        <div class="bg" style="background-image: url(<?php echo Photographs::get_image($ad->photo, 'larg'); ?>);">
          &nbsp;</div>
          </a>
          <?php
          if($ad->content){
          ?>
        <p><?php echo $ad->content;?></p>
      <?php }?>
			</div>

		</div>
    <?php endforeach; ?>
	</div>
</div>
<!-- Contact Boxes END -->

<?php
}
$sec_id=0;
?>
