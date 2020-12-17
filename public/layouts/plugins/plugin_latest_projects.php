<?php global $session; ?>
<section class="popular-courses">

    <?php
    $main_subject_req = MainCategory::find_all('sort_id ASC', "WHERE id=2 AND publish=1 AND site_id={$session->site_id}");
    $main_subject_req = $main_subject_req[0];
    $main_subject = $main_subject_req->url_alias;
    $subjects = Subject::find_all("RAND() LIMIT 12", " WHERE main_id=" . $main_subject_req->id . " AND publish=1");
    ?>
    <div class="container">
        <div class="row">
            <div class="section-heading text-center">
                <h1><a href="./?module=Main_Sections&main_subject=Projects"><?php echo Plugin::find_viewed_language('title', 3, Plugin::$trans_key) ?></a></h1>
                <img src="images/img/line-dec.png" alt="">
            </div>
        </div>
        <div class="row">
            <div id="owl-courses">

                <?php foreach ($subjects as $subject): ?>
                    <div class="item course-item">
                        <?php if (!empty($subject->photo)) { ?>
                            <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>">
                                <img src="<?php echo Photographs::get_image($subject->photo, 'larg'); ?>" width="345" height="200" alt="">
                            </a>
                        <?php } ?>
                        <div class="down-content">

                            <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>">
                                <h4><?php echo Subject::find_viewed_language('title', $subject->id, Subject::$trans_key) ?></h4>
                            </a>
                            <p><?php echo nl2br(Subject::find_viewed_language('content_short', $subject->id, Subject::$trans_key)) ?></p>
                            <div class="text-button">
                                <a href="./?module=<?php echo Module::find_alias('module_main_subject.php'); ?>&main_subject=<?php echo $main_subject ?>&subject=<?php echo $subject->url_alias ?>"><?php echo read_xmls('/site/frontend/news/labels/more') ?><i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>