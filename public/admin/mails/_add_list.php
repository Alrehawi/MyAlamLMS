<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST") && @$_POST['emails'] && @$_POST['mail_groups_id']) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }  
    $user_admin = User::find_by_id($session->user_id);
    $message = '';
    if (!empty($_POST['emails'])) {
        $array_mails = Mail::get_array_mail(trim($_POST['emails']));
        //echo "<pre>";
        //print_r($array_mails);exit;
        foreach ($array_mails as $mail):
            if (!empty($mail)) {
                $mails = new Mail();
                @$mails->email = trim($mail);
                @$mails->mail_groups_id = trim($_POST['mail_groups_id']);
                @$mails->publish = 1;
                @$mails->created = current_date();
                if ($mails->save_mail()) {
                    $message[] = "{$mail}: " . read_xmls('/site/msg/sucuadd');
                    //echo log_action("Add New Mail: {$mail} " , "By: {$user_admin->username}");
                } else {
                    $message[] = join("<br/>", $mails->errors);
                }
            }
        endforeach;
        $session->message(join("<br/>", $message));
        redirect_to('_add_list.php');
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>

  <!-- /.row -->
<?php echo output_message($message, 150); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/mail/titles/addlist') ?></h2>
                <a class="btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/mail/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
                <a class="btn btn-primary pull-left" href="_add.php"><?php echo read_xmls('/site/mail/titles/add') ?>
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_add_list.php" method="POST" enctype="multimail/form-data">
                           <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/mail/lables/name') ?></label>
                               <textarea class="form-control" name="emails" style="height:150PX;"><?php echo check_var("emails", "POST"); ?></textarea>
                                <?php echo read_xmls('/site/mail/lables/canuse') ?>
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
