<?php
global $session, $database, $hide_title,$plugin_menu_stages;

$subject = Subject::find_all("sort_id ASC", "WHERE url_alias='" . $database->escape_value($_GET['subject']) . "' AND publish=1");
$subject = $subject[0];
if (!MainCategory::count_all("WHERE id='" . $database->escape_value($subject->main_id) . "' AND publish=1")) {
  redirect_to(FILE_RELATIVES.DS.'error.php');
}
$subject_title = Subject::find_viewed_language('title', $subject->id, Subject::$trans_key);
Subject::increase_counter($subject->id);
?>
<!-- Blog Post START -->
<div class="section-block">
  <div class="container">
    <div class="row">
      <!-- Left Side START -->
      <div class="col-md-12 col-sm-12 col-12">
        <div class="blog-list-left">
          <?php if (!empty($subject->photo)) { ?>
            <a class="portfolio-item-link" data-rel="prettyPhoto"  href="<?php echo Photographs::get_image($subject->photo, 'larg'); ?>"><img src="<?php echo Photographs::get_image($subject->photo, 'larg'); ?>" alt="img"></a>
          <?php } ?>

          <div class="blog-title-box">
            <h2><?php echo $subject_title;?></h2>

            <?php
            if ($subject->show_date) {
              if (empty($subject->subject_date)) {
                $date_sub = simple_date_slash($subject->created);
              } else {
                $date_sub = simple_date_slash($subject->subject_date);
              }
              ?>
              <span><i class="fa fa-calendar"></i><?php echo $date_sub ?></span>

            <?php } ?>

          </div>

          <div class="blog-post-content">

            <p>
              <?php
              $contentTXT =  Subject::find_viewed_language('content', $subject->id, Subject::$trans_key);
              echo replaceImagesFromTXT($contentTXT);
              $images = findImagesFromTXT($contentTXT);
              echo $images;
              ?>
            </p>


          </div>
        </div>
      </div>
      <!-- Left Side END -->


    </div>
  </div>
</div>
