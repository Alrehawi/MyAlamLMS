<?php
global $session, $sec_id,$hide_title, $pagination, $paging;

if (empty($sec_id)) {
    echo read_xmls("/site/msg/pluginnosec");
} else {

$main_subject_req = MainCategory::find_all('sort_id ASC', "WHERE id={$sec_id} AND publish=1");
$main_subject_req = $main_subject_req[0];
$main_subject = $main_subject_req->url_alias;
$paging = !empty($_GET['paging']) ? (int) $_GET['paging'] : 1;
$per_page = $main_subject_req->paging;
$total_count = Subject::count_by_field('main_id', $main_subject_req->id, 'AND publish=1 ');
$pagination = new Pagination($paging, $per_page, $total_count);
$subjects = Subject::find_all("sort_id {$main_subject_req->subject_sort} LIMIT {$per_page} OFFSET {$pagination->offset()}", " WHERE main_id=" . $main_subject_req->id . " AND publish=1");
?>
<div class="latest-projects-wrapp">
    <div class="container">
        <div class="one-fourth">
            <h4><?php echo MainCategory::find_viewed_language('title', $main_subject_req->id, MainCategory::$trans_key) ?></h4>
            <p><?php echo MainCategory::find_viewed_language('content', $main_subject_req->id, MainCategory::$trans_key) ?></p>
            <br>
            <p>
                <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>" class="button color small round"><?php echo read_xmls('/site/frontend/news/labels/more') ?></a>
            </p>
        </div>
        <div class="three-fourth last">
            <div class="jcarousel-container  jcarousel-container-horizontal" style="position: relative; display: block;"><!--project carousel starts-->
                <div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;"><ul id="projects-carousel" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px; width: 1540px;">

                        <?php foreach ($subjects as $subject): ?>
                            <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-2 jcarousel-item-2-horizontal" jcarouselindex="2" style="float: left; list-style: none;">

                                <div class="portfolio-item">
                                    <?php if (!empty($subject->photo)) { ?>
                                        <a href="<?php echo Photographs::get_image($subject->photo, 'larg'); ?>" class="portfolio-item-link" data-rel="prettyPhoto">
                                            <span class="portfolio-item-hover" style="opacity: 0;"></span><img src="<?php echo Photographs::get_image($subject->photo, 'larg'); ?>" alt=" ">
                                        </a>
                                    <?php } ?>
                                    <div class="portfolio-item-title">
                                        <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>"><?php echo Subject::find_viewed_language('title', $subject->id, Subject::$trans_key) ?></a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul></div>
                <div class="jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal" disabled="disabled" style="display: block;"></div><div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div></div><!--project carousel ends-->
        </div>
    </div>
</div>
<?php
}
$sec_id=0;
?>
