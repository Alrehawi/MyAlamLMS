<?php
global $session, $sec_id;
if (empty($sec_id)) {
    echo read_xmls("/site/msg/pluginnosec");
} else {
?>

<!-- Clients Carousel START -->
<div class="section-clients border-top border-bottom">
	<div class="container">
		<div class="owl-carousel owl-theme clients" id="clients">
      <?php
      $ads = Ad::find_by_adsec($sec_id, ' ORDER BY sort_id ASC LIMIT 10 ');
      foreach ($ads as $ad):
      $AdTitle = Ad::find_viewed_language('title', $ad->id, 'ad');
      ?>
			<div class="item"><a href="<?php echo $ad->url; ?>" target="<?php echo $ad->target; ?>" title="<?php echo $AdTitle; ?>"><img src="<?php echo Photographs::get_image($ad->photo, 'larg'); ?>" alt="<?php echo $AdTitle; ?>" style="height:114px"></a></div>
      <?php endforeach; ?>
		</div>
	</div>
</div>
<!-- Clients Carousel END -->

<?php }
$sec_id=0;
?>
