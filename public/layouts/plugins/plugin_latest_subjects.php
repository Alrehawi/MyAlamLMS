<?php
global $session, $sec_id;

if (empty($sec_id)) {
    echo read_xmls("/site/msg/pluginnosec");
} else {
    ?>
    <div class='block_latest latest_subjects-graduate'>
        <div id="latest_subjects">
            <ul>
                <!-- Start -->
                <?php
                $subjects = Subject::find_all("id DESC LIMIT 6"," where main_id={$sec_id} ");
                foreach ($subjects as $subject):
                    $main_subject = Maincategory::find_by_id($subject->main_id);
                    $main_subject=$main_subject->url_alias;

                    ?>
                    <div class="blog-post graduate">

                        <?php if (!empty($subject->photo)) { ?>
                             <h4><a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>"><?php echo Subject::find_viewed_language('title', $subject->id, Subject::$trans_key) ?></a></h4>

                            <div class="media-holder">
                              <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>" ><span class="portfolio-item-hover"></span><img src="<?php echo Photographs::get_image($subject->photo, 'larg'); ?>" alt="" /></a>
                               <div class="moreLink">
                                <!-- <center> -->
                                <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>" class="button color small round"><?php echo read_xmls('/site/frontend/news/labels/more') ?></a>
                               <!-- </center> -->
                               </div>
                            </div>
                        <?php } ?>

                        <div class="permalink">
                        <?php
                        if ($subject->show_date) {
                            if (empty($subject->subject_date)) {
                                $date_sub = simple_date_slash($subject->created);
                            } else {
                                $date_sub = simple_date_slash($subject->subject_date);
                            }
                            ?>
                            <p class="icon-time"></i> <?php echo $date_sub ?> </p>
                        <?php } ?>
                        <p>
                            <?php echo nl2br(Subject::find_viewed_language('content_short', $subject->id, Subject::$trans_key)) ?>            </p>
                      </div>

                    </div>
                <?php endforeach; ?>
                <!-- End-->
            </ul>
        </div>
    </div>
    <div style='clear:both;'></div>
    <?php
}
$sec_id=0;
?>
