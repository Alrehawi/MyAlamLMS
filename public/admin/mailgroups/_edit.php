<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailGroupEdit', '_manage.php');


if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$MailGroup = MailGroup::find_by_id($_GET['id']," AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $MailGroups = new MailGroup();
    $MailGroups->id = $_GET['id'];
    $MailGroups->title = trim($_POST['title']);
    $MailGroups->lang_id = $MailGroup->lang_id;
    $MailGroups->newsletter = $MailGroup->newsletter;
    $MailGroups->publish = $MailGroup->publish;
    $mailgroups->site_id = $MailGroup->site_id;
    $MailGroups->created = $MailGroup->created;
    $MailGroups->updated = current_date();

    if ($MailGroups->save_MailGroup($MailGroup->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update MailGroup: {$MailGroups->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $MailGroup->id);
    } else {
        $message = join("<br/>", $MailGroups->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/mailgroup/titles/edit') ?>: <?php echo $MailGroup->title; ?></h2>
                <a class="btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/mailgroup/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
                <?php if ($session->has_permission('MailGroupTranslate')) { ?>
                    <a class="btn btn-info pull-left margin-link" href="_translate.php?parent=<?php echo $MailGroup->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?><i class="fa fa-language margin-right-fivePx"></i></a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="MailGroup" action="_edit.php?id=<?php echo $MailGroup->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/mailgroup/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo $MailGroup->title; ?>" maxlength="255">
                                    <?php echo read_xmls('/site/mailgroup/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
