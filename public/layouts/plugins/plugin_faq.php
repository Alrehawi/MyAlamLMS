<?php
global $session, $sec_id;

if (empty($sec_id)) {
    echo read_xmls("/site/msg/pluginnosec");
} else {
    ?>
    <div class="body">
      <?php
      $mains = MainCategory::find_all("sort_id ASC", "WHERE publish=1 AND parent_id={$sec_id} AND site_id={$session->site_id}");
      foreach ($mains as $main):
      ?>
        <div class="panel-group" id="faqAccordion<?php echo $main->id?>">
          <h3><?php echo MainCategory::find_viewed_language('title', $main->id, MainCategory::$trans_key) ?></h3>
          <?php
          $subjects = Subject::find_all(" sort_id {$main->subject_sort} ", " WHERE main_id={$main->id} AND publish=1 ");
          foreach ($subjects as $subject):
          ?>
            <div class="panel panel-default ">
                <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion<?php echo $main->id?>" data-target="#question<?php echo $subject->id?>">
                     <h4 class="panel-title">
                        <a href="#" class="ing"><?php echo Subject::find_viewed_language('title', $subject->id, Subject::$trans_key) ?></a>
                  </h4>

                </div>
                <div id="question<?php echo $subject->id?>" class="panel-collapse collapse" style="height: 0px;">
                    <div class="panel-body">
                         <!-- <h5><span class="label label-primary">Answer</span></h5> -->
                        <p><?php echo nl2br(strip_tags(Subject::find_viewed_language('content', $subject->id, Subject::$trans_key))) ?></p>
                    </div>
                </div>
            </div>
          <?php endforeach;?>
        </div>
      <?php endforeach;?>
        <!--/panel-group-->
    </div>
    <?php
}
$sec_id=0;
?>
