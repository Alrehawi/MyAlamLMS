<?php global $session, $page_title, $hide_title, $pagination, $paging;
if (isset($_GET['main_subject'])) {
  if ($_GET['main_subject'] && MainCategory::count_by_field('url_alias', $_GET['main_subject']))
  echo include_layout_template('main_subject_show.php');
  else
  redirect_to(FILE_RELATIVES.DS.'error.php');
} else {

  $paging = !empty($_GET['paging']) ? (int) $_GET['paging'] : 1;
  if (SiteConfig::site_config('paging'))
  $per_page = SiteConfig::site_config('paging');
  else
  $per_page = 15;
  $total_count = MainCategory::count_all('WHERE publish=1');
  $pagination = new Pagination($paging, $per_page, $total_count);
  $main_subjects = MainCategory::find_all("id ASC LIMIT {$per_page} OFFSET {$pagination->offset()}", ' WHERE publish=1');
  ?>

   <?php if (!$hide_title) { ?>
      <h1 class="breadcrumb-head"><?php echo $page_title; ?></h1>
    <?php } ?>
  <div class="body">
    <ul class="single-project-list"><!--check list starts -->
      <?php
      foreach ($main_subjects as $main_subject):
        ?>
        <li><span></span><a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject->url_alias ?>"><?php echo MainCategory::find_viewed_language('title', $main_subject->id, 'main') ?></a></li>
      <?php endforeach; ?>
    </ul>

    <!-- Pagination -->
    <nav class="pagination">
      <ul>
        <?php echo include_layout_template('pagination_front.php'); ?>
      </ul>
      <div class="clearfix">
      </div>
    </nav>
    <!-- End pagination -->

  </div>

<?php
}?>
