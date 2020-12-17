<?php
global $session, $page_title, $hide_title, $pagination, $paging;
if (isset($_GET['gallery'])) {
  if ($_GET['gallery'] && Gallery::count_by_field('url_alias', $_GET['gallery']))
  echo include_layout_template('gallery_show.php');
  else
  redirect_to(FILE_RELATIVES.DS.'error.php');
} else {

  $paging = !empty($_GET['paging']) ? (int) $_GET['paging'] : 1;
  if (SiteConfig::site_config('paging'))
  $per_page = SiteConfig::site_config('paging');
  else
  $per_page = 5;
  $total_count = Gallery::count_all('WHERE publish=1');
  $pagination = new Pagination($paging, $per_page, $total_count);
  $galleries = Gallery::find_all("id ASC LIMIT {$per_page} OFFSET {$pagination->offset()}", ' WHERE publish=1');
  ?>


  <div class="box1">
    <?php if (!$hide_title) { ?>
        <h1 class="breadcrumb-head"><?php echo $page_title; ?></h1>
    <?php } ?>
    <div class="body">
      <ul class="single-project-list"><!--check list starts -->
        <?php
        foreach ($galleries as $gallery):
          ?>
          <li><span></span> <a href="./?module=<?php echo Module::find_alias('module_gallery.php'); ?>&gallery=<?php echo $gallery->url_alias ?>" class=""><?php echo Gallery::find_viewed_language('title', $gallery->id, Gallery::$trans_key) ?></a></li>
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
  </div>


  <?php
}
?>
