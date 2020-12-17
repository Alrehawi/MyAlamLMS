<?php
global $session, $sec_id;

if (empty($sec_id)) {
  echo read_xmls("/site/msg/pluginnosec");
} else {
  ?>
  <?php
  $main_subject_req = MainCategory::find_all('sort_id ASC', "WHERE id={$sec_id} AND publish=1");
  $main_subject_req = $main_subject_req[0];
  $main_subject = $main_subject_req->url_alias;
  $subjects = Subject::find_all(" subject_date {$main_subject_req->subject_sort} LIMIT 3", " WHERE main_id=" . $main_subject_req->id . " AND publish=1");
  //$subjects = Subject::find_by_sql(" SELECT z.* FROM (SELECT a.*,(SELECT b.parent_id from mains b where a.main_id = b.id) main_parent_id FROM `subjects` a)z  WHERE z.main_parent_id=" . $main_subject_req->id . " AND z.publish=1 ORDER BY z.id {$main_subject_req->subject_sort} LIMIT 6");

  ?>


  <!-- Blog Grid START -->
  <div class="section-block-grey">
    <div class="section-heading center-holder">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-sm-10">
            <h3><?php echo MainCategory::find_viewed_language('title', $main_subject_req->id, MainCategory::$trans_key); ?></h3>
            <div class="section-heading-line">&nbsp;</div>
          </div>
          <div class="col-lg-2 col-sm-12">
            <span><a class="primary-button button-md mt-30" href="./?module=<?php echo Module::find_alias('module_all_news.php'); ?>">المزيد من الأخبار</a></span>
          </div>

          <p><?php echo strip_tags(MainCategory::find_viewed_language('content', $main_subject_req->id, MainCategory::$trans_key)); ?></p>
        </div>
      </div>
    </div>
  	<div class="container">
  		<div class="row">
        <?php
        foreach ($subjects as $subject):
          if($subject->photo){
            $imgNews= Photographs::get_image($subject->photo, 'larg');
          } else {
            $imgNews= Photographs::get_image(SiteConfig::site_config('logo_path'), 'larg');
          }
        if ($subject->show_date) {
          if (empty($subject->subject_date)) {
            $date_sub = simple_date_slash($subject->created);
          } else {
            $date_sub = simple_date_slash($subject->subject_date);
          }
          $dayNews=date("d", strtotime($date_sub));
          $monthNews=date("M", strtotime($date_sub));
          }
          ?>

  			<div class="col-md-4 col-sm-4 col-12">
  				<div class="blog-grid">
            <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>">
              <div class="blog-grid-img" style="background-image: url(<?php echo $imgNews ?>);">

              <div class="data-box-grid">

                <h4><?php echo $dayNews;?></h4>
                <p><?php echo $monthNews;?></p>
              </div>
  					</div>
            </a>
  					<div class="blog-grid-text">
  						<!-- <span>Business</span> -->
  						<h4><?php echo limit_words(Subject::find_viewed_language('title', $subject->id, Subject::$trans_key),12); ?>...</h4>
  						<ul>
  							<li><?php echo $date_sub ?></li>
  						</ul>
              <?php
              if(Subject::find_viewed_language('content_short', $subject->id, Subject::$trans_key)){
              ?>
  						<p><?php echo limit_words(Subject::find_viewed_language('content_short', $subject->id, Subject::$trans_key),18) ?>  ...</p>
            <?php } else {?>
              <p><?php echo limit_words(strip_tags(Subject::find_viewed_language('content', $subject->id, Subject::$trans_key)),18) ?>  ...</p>
            <?php }?>
  						<div class="mt-20 left-holder">
  							<a class="primary-button button-sm" href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>"><?php echo read_xmls('/site/frontend/news/labels/more') ?></a></div>
  					</div>
  				</div>
  			</div>
        <?php endforeach; ?>


  		</div>
  	</div>
  </div>
  <!-- Blog Grid END -->


  <?php
}
$sec_id=0;
?>
