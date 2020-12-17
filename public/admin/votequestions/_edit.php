<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('VoteQuestionEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$votequestion = VoteQuestion::find_by_id($_GET['id'], " AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $votequestions = new VoteQuestion();
    @$votequestions->id = $_GET['id'];
    @$votequestions->title = trim($_POST['title']);
    @$votequestions->lang_id = $votequestion->lang_id;
    @$votequestions->publish = $votequestion->publish;
    @$votequestions->site_id = $votequestion->site_id;
    @$votequestions->created = $votequestion->created;
    @$votequestions->updated = current_date();
    if ($votequestions->save_VoteQuestion($votequestion->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update VoteQuestion: {$votequestions->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $votequestion->id);
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
                <h2><?php echo read_xmls('/site/votequestion/titles/edit') ?> : <?php echo $votequestion->title; ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/votequestion/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="votequestion" action="_edit.php?id=<?php echo $votequestion->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/votequestion/lables/name') ?>.</label>
                                <input class="form-control" type="text" name="title" value="<?php echo $votequestion->title; ?>" maxlength="250"> &nbsp;
                               <?php echo read_xmls('/site/votequestion/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
