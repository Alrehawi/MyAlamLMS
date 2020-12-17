<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('VoteAnswerEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$voteanswer = VoteAnswer::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $voteanswers = new VoteAnswer();
    @$voteanswers->id = $_GET['id'];
    @$voteanswers->title = trim($_POST['title']);
    @$voteanswers->question_id = trim($_POST['question_id']);
    @$voteanswers->counter = $voteanswer->counter;
    @$voteanswers->publish = $voteanswer->publish;
    @$voteanswers->sort_id = $voteanswer->sort_id;
    @$voteanswers->lang_id = $voteanswer->lang_id;
    @$voteanswers->created = $voteanswer->created;
    @$voteanswers->updated = current_date();
    if ($voteanswers->save_VoteAnswer($voteanswer->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update VoteAnswer: {$voteanswers->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $voteanswer->id);
    } else {
        $message = join("<br/>", $voteanswers->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/votequestion/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/votequestion/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="voteanswer" action="_edit.php?id=<?php echo $voteanswer->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/voteanswer/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" required value="<?php echo $voteanswer->title; ?>" maxlength="250" />
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/voteanswer/lables/questionid') ?></label>
                               <select  class="form-control" name="question_id">
                                <?php
                                $questions = VoteQuestion::find_all("title ASC","WHERE site_id={$session->site_id}");
                                foreach ($questions as $question):
                                    ?>
                                    <option value='<?php echo $question->id; ?>'<?php
                                    if (@$voteanswer->title == $question->id) {
                                        echo ' selected';
                                    }
                                    ?>><?php echo VoteQuestion::find_viewed_language('title', intval($question->id), VoteQuestion::$trans_key) ?></option>
                                    <?php endforeach; ?>
                            </select>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
