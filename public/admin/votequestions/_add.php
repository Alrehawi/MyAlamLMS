<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('VoteQuestionAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $user_admin = User::find_by_id($session->user_id);
    // assign new sort id
    $votequestions = new VoteQuestion();
    @$votequestions->title = trim($_POST['title']);
    // get default lang ID
    @$default_lang = Language::get_default_lang();
    @$votequestions->lang_id = $default_lang[0]->id;
    @$votequestions->publish = 1;
    @$votequestions->site_id = $session->site_id;
    @$votequestions->created = current_date();

    if ($votequestions->save_VoteQuestion()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New VoteQuestion: {$votequestions->title} ", "By: {$user_admin->username}");

        //save answers
        if (!empty($_POST['answer'])) {
            foreach ($_POST['answer'] as $ans):
                $new_sort_id_ans = VoteAnswer::count_new_sort_id("WHERE question_id=" . $votequestions->id);
                @$answers = new VoteAnswer();
                @$answers->title = $ans;
                @$answers->question_id = $votequestions->id;
                @$answers->sort_id = $new_sort_id_ans;
                @$answers->publish = 1;
                @$answers->lang_id = $default_lang[0]->id;
                @$answers->created = current_date();
                @$answers->save();
            endforeach;
        }
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $votequestions->errors);
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
                                <label><?php echo read_xmls('/site/votequestion/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="250" />
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/voteanswer/lables/name') ?></label>
                                <input class="form-control" type="hidden" value="1" id="theValue" />

                               <div id="myDiv">
                                    <input class="form-control" name="answer[]" type="text" value="" /> <a href="javascript:;" onclick="addEvent('<input name=\'answer[]\' type=\'text\' />');"><?php echo show_icon('add.png',read_xmls('/site/votequestion/lables/addanswer'))?> </a>
                                </div>
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
