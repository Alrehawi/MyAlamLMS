<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailGroupAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $user_admin = User::find_by_id($session->user_id);
    // assign new sort id
    $mailgroups = new MailGroup();
    $mailgroups->title = trim($_POST['title']);
    // get default lang ID
    $default_lang = Language::get_default_lang();
    $mailgroups->lang_id = $default_lang[0]->id;

    $mailgroups->publish = 1;
    $mailgroups->site_id = $session->site_id;
    $mailgroups->created = current_date();
    // get default lang ID

    if ($mailgroups->save_mailgroup()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New MailGroup: {$mailgroups->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $mailgroups->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/mailgroup/titles/add') ?></h2>
                <a class="btn btn-primary pull-left"  href="_manage.php"><?php echo read_xmls('/site/mailgroup/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="mailgroup" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/mailgroup/lables/name') ?></label>
                                <input class="form-control"  type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" />
                                    <?php echo read_xmls('/site/mailmessage/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
