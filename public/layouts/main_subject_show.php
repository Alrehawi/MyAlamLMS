<?php
global $session, $hide_title, $database, $pagination, $paging,$plugin_menu_stages;

if (isset($_GET['subject'])) {
    if ($_GET['subject'] && Subject::count_by_field('url_alias', $_GET['subject']))
        echo include_layout_template('subject_show.php');
    else
      redirect_to(FILE_RELATIVES.DS.'error.php');
} else {
    $main_subject = trim($_GET['main_subject']);
    if (!isset($_GET['main_subject']) || !MainCategory::count_all("WHERE url_alias='" . $database->escape_value($main_subject) . "' AND publish=1")) {
        redirect_to(FILE_RELATIVES.DS.'error.php');
    }

    $main_subject_req = MainCategory::find_all('sort_id DESC', "WHERE url_alias='" . $database->escape_value($main_subject) . "' AND publish=1");
    $main_subject_req = $main_subject_req[0];

    $paging = !empty($_GET['paging']) ? (int) $_GET['paging'] : 1;
    $per_page = $main_subject_req->paging;
    $total_count = Subject::count_by_field('main_id', $main_subject_req->id, 'AND publish=1 ');
    $pagination = new Pagination($paging, $per_page, $total_count);
    $subjects = Subject::find_all("sort_id {$main_subject_req->subject_sort} LIMIT {$per_page} OFFSET {$pagination->offset()}", " WHERE main_id=" . $main_subject_req->id . " AND publish=1");
    if ($main_subject_req->layout == 2) {
    ?>

        <!-- Blog Grid START -->
        <div class="section-block">

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
                      <?php if ($subject->show_date) {?>
                    <div class="data-box-grid">

                      <h4><?php echo $dayNews;?></h4>
                      <p><?php echo $monthNews;?></p>
                    </div>
                  <?php } ?>
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
              <div class="clearfix">
              </div>
            </div>
              <div class="pagination">
                <ul>
                  <?php echo include_layout_template('pagination_front.php'); ?>
                </ul>

        		</div>
        	</div>
        </div>
        <!-- Blog Grid END -->

<?php } else{ ?>
  <!-- Blog List START -->
  <div class="section-block">
    <div class="container">

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


      <div class="blog-list-simple">
        <div class="row">
          <div class="col-md-5 col-sm-5 col-12">
            <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>">
            <div class="blog-list-simple-img"  style="background-image: url(<?php echo $imgNews ?>);">
              <div class="data-box-simple">
                <h4><?php echo $dayNews;?></h4>
                <p><?php echo $monthNews;?></p>
              </div>
            </div>
          </a>
          </div>
          <div class="col-md-7 col-sm-7 col-12">
            <div class="blog-list-simple-text">

              <h4><?php echo limit_words(Subject::find_viewed_language('title', $subject->id, Subject::$trans_key),12); ?>...</h4>
              <ul>
                <li><i class="fa fa-clock-o"></i><?php echo $date_sub ?></li>
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
      </div>
<?php endforeach; ?>
<div class="pagination">
  <ul>
    <?php echo include_layout_template('pagination_front.php'); ?>
  </ul>

</div>

    </div>
  </div>
  <!-- Blog List END -->

      <?php } ?>
<?php } ?>
