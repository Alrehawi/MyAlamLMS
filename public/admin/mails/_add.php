<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }  
    $user_admin = User::find_by_id($session->user_id);
    @$mails = new Mail();
    @$mails->email = trim($_POST['email']);
    @$mails->mobile = trim($_POST['mobile']);
    @$mails->mail_groups_id = trim($_POST['mail_groups_id']);
    @$mails->publish = 1;
    @$mails->created = current_date();

    if ($mails->save_mail()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Mail: {$mails->email} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $mails->errors);
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

                <h2><?php echo read_xmls('/site/mail/titles/add') ?></h2>
                <a class="btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/mail/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
                <a class="btn btn-primary pull-left" href="_add_list.php"><?php echo read_xmls('/site/mail/titles/addlist') ?>
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_add.php" method="POST" enctype="multimail/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/mail/lables/name') ?></label>
                                <input class="form-control" type="text" name="email" value="<?php echo check_var("email", "POST"); ?>" maxlength="255">
                               <?php echo read_xmls('/site/mail/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/mail/lables/mobile') ?></label>
                               <input class="form-control" name="mobile" type="text" id="mobile" value="<?php echo check_var("mobile", "POST"); ?>" maxlength="12"  onkeypress='return isNumberKey(event)'/>
                              966544330099
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/mailgroup/titles/main') ?></label>
                                <select  class="form-control" name="mail_groups_id">
                                    <?php
                                    //Get all MailGroups
                                    $mains = MailGroup::find_all("title ASC","WHERE site_id={$session->site_id}");
                                    foreach ($mains as $main):
                                        ?>
                                        <option value='<?php echo $main->id; ?>'<?php if (check_var("mail_groups_id", "POST") == $main->id) {
                                        echo ' selected';
                                    } ?>><?php echo $main->title; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
