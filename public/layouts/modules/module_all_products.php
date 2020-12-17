<?php
global $session, $page_title, $hide_title, $pagination, $paging;


  $paging = !empty($_GET['paging']) ? (int) $_GET['paging'] : 1;
  if (SiteConfig::site_config('paging'))
  $per_page = SiteConfig::site_config('paging');
  else
  $per_page = 20;


  $sql =" select * from medias WHERE publish=1 and media_type = 'image' ";

  $total_count = Media::count_by_sql_stat($sql);
  $pagination = new Pagination($paging, $per_page, $total_count);
  $medias = Media::find_by_sql( $sql." LIMIT ".$per_page." OFFSET ".$pagination->offset());
  ?>


  <!--News-->
<div class="section-news" style="padding:0 !important;">
  <div class="container">
    <div class="row">
      <div class="top">
        <div>
           <h2><?php echo Module::find_viewed_language('title', 27, MainCategory::$trans_key); ?></h2>
           <div class="line">
             <div></div>
           </div>
        </div>
      </div>
    </div>
    <div class="row">

      <?php foreach ($medias as $media):
        $gallery = Gallery::find_by_id($media->gallery_id);
         ?>
        <div class="col-md-4 col-sm-6 col-xs-12 content">
            <a id="popup-media" class="portfolio-item-link" data-rel="prettyPhoto[gal]" title="<?php echo $media->title;?>" href="<?php echo $media->get_image($media->id , 'larg',$media->gallery_id);?>">
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
                  <p class="date"><a href="./?module=<?php echo Module::find_alias('module_gallery.php'); ?>&gallery=<?php echo $gallery->url_alias ?>"><?php echo Gallery::find_viewed_language('title', $gallery->id, Gallery::$trans_key); ?></a></p>
              </div>

            </a>
        </div>
      <?php endforeach; ?>

      <nav class="pagination">
        <ul>
          <?php echo include_layout_template('pagination_front.php'); ?>
        </ul>
        <div class="clearfix">
        </div>
      </nav>

    </div>
  </div>
</div>
