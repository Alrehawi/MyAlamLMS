<?php
global $session, $sec_id;
if (empty($sec_id)) {
    echo read_xmls("/site/msg/pluginnosec");
} else {
    ?>

      <!--Slider-->
 <section class="slider" id="main-slider">
    <div id="owl-demo" class="owl-carousel owl-theme">
      <?php
      $ads = Ad::find_by_adsec($sec_id);
      foreach ($ads as $ad):
          $AdTitle = Ad::find_viewed_language('title', $ad->id, 'ad');
          $AdDesc = Ad::find_viewed_language('content', $ad->id, 'ad');
          ?>
        <div class="item" style="position:relative">

          <div class="slider_content">
            <div class="content_slider">
                <h2><?php echo $AdTitle?></h2>

               <p><a href="<?php echo $ad->url?>" target="<?php echo $ad->target?>"><?php echo $AdDesc?></a></p>
             </div>
            </div>
            <img src="<?php echo Photographs::get_image($ad->photo, 'larg'); ?>" alt="" />
          </div>
          <?php endforeach; ?>
    </div>
</section>

    <?php
}
$sec_id=0;?>
