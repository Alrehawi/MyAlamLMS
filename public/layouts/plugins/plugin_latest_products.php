<?php
global $session;

  ?>
  <?php
  $medias = Media::find_all("  rand() limit 9", " WHERE  publish=1 and media_type = 'image'");
  ?>
  <!--News-->
<div class="section-news">
  <div class="container">
    <div class="row">
      <div class="top">
        <div>
           <h2><?php echo Module::find_viewed_language('title', 27, MainCategory::$trans_key); ?></h2>
           <div class="line">
             <div></div>
           </div>
           <a href="./?module=<?php echo Module::find_alias('module_all_products.php'); ?>"><?php echo read_xmls('/site/frontend/news/labels/more') ?></a>
        </div>
      </div>
    </div>
    <div class="row">

      <?php foreach ($medias as $media): ?>
        <div class="col-md-4 col-sm-6 col-xs-12 content">
            <a href="./?module=<?php echo Module::find_alias('module_all_products.php'); ?>">
              <div class="bg">
                <?php if($media->id){
                  $imgNews=  $media->get_image($media->id , 'larg',$media->gallery_id);
                } else {
                  $imgNews= Photographs::get_image(SiteConfig::site_config('logo_path'), 'larg');
                }
                ?>
                <div style="background-image: url(<?php echo $imgNews ?>);"></div>
                <div class="overly"></div>
              </div>
              <div class="txt">
                  <h3><?php echo limit_words(Media::find_viewed_language('title', $media->id, Media::$trans_key),6); ?></h3>
              </div>
            </a>
        </div>
      <?php endforeach; ?>



    </div>
  </div>
</div>
