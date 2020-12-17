<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('VoteAnswerAdd', '_manage.php');
$question_id = @intval($_GET['question_id']);
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $user_admin = User::find_by_id($session->user_id);
    // assign new sort id
    $voteanswers = new VoteAnswer();
    @$voteanswers->title = trim($_POST['title']);
    @$voteanswers->question_id = trim($_POST['question_id']);
    @$new_sort_id = VoteAnswer::count_new_sort_id("WHERE question_id=" . @intval($_POST['question_id']));
    @$voteanswers->sort_id = $new_sort_id;
    @$default_lang = Language::get_default_lang();
    @$voteanswers->lang_id = $default_lang[0]->id;
    @$voteanswers->publish = 1;
    @$voteanswers->created = current_date();

    if ($voteanswers->save_VoteAnswer()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New VoteAnswer: {$voteanswers->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
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
                        <form name="votequestion" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/voteanswer/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" required value="<?php echo check_var("title", "POST"); ?>" maxlength="250" />
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/voteanswer/lables/questionid') ?></label>
                                <select  class="form-control" name="question_id">
                                    <?php
                                    $questions = VoteQuestion::find_all("title ASC","WHERE site_id={$session->site_id}");
                                    foreach ($questions as $question):
                                        ?>
                                        <option value='<?php echo $question->id; ?>'<?php
                                        if (@$_POST['question_id'] == $question->id || $question->id == @$question_id) {
                                            echo ' selected';
                                        }
                                        ?>><?php echo VoteQuestion::find_viewed_language('title', intval($question->id), VoteQuestion::$trans_key) ?></option>
                                            <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
