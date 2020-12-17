<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailSend', '_manage.php');

global $database, $session, $Subject, $content, $To, $msg, $direction;
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $user_admin = User::find_by_id($session->user_id);
    @$mailmessages = new MailMessage();
    @$mailmessages->from = trim($_POST['from']);
    @$mailmessages->subject = trim($_POST['subject']);
    @$mailmessages->mail_groups_id = trim($_POST['mail_groups_id']);
    @$mailmessages->content = trim($_POST['content']);
    @$mailmessages->direction = $_POST['direction'];
    @$mailmessages->created = current_date();

    //sending message
    $To = TO_EMAIL;
    $From = trim($_POST['from']);
    $content = trim($_POST['content']);
    $direction = $_POST['direction'];
    $Subject = SiteConfig::site_config('title') . ' :: ' . trim($_POST['subject']);
    //get template
    echo include_layout_template('email_templates/mail_template.php');
    $MailMsg = $msg;
    $SucMsg = read_xmls('/site/frontend/msg/sentsuccess');
    $ErrorMsg = read_xmls('/site/frontend/msg/cantsendemail');
    $Cc = '';
    //echo  $MailMsg;

    if ($mailmessages->save_mail_message()) {
        echo MailMessage::send_emails($To, $From, $Subject, $MailMsg, $SucMsg, $ErrorMsg, $Cc, $mailmessages->mail_groups_id, 5);
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Send New Mail Message: {$mailmessages->subject} ", "By: {$user_admin->username}");
        redirect_to("_send.php");
    } else {
        $message = join("<br/>", $mailmessages->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>

<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/mailmessage/titles/send') ?></h2>
                <a class="btn btn-primary pull-left"  href="_manage.php"><?php echo read_xmls('/site/mailmessage/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="assign" action="_add.php?menu_type=<?php echo $menu_type; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/mailmessage/lables/from') ?> </label>
                                <input class="form-control"  name="from" type="text" id="from" value="<?php if (@$_POST['from']) echo $_POST['from'];
                                    else echo SiteConfig::site_config('email') ?>" maxlength='50'>
                                    <?php echo read_xmls('/site/mailmessage/lables/charnum') ?>
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/mailmessage/lables/direction') ?></label>
                                <select  class="form-control" name="direction">
                                    <option value="ltr"><?php echo read_xmls('/site/mailmessage/lables/ltr') ?></option>
                                    <option value="rtl"><?php echo read_xmls('/site/mailmessage/lables/rtl') ?></option>
                                </select>
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
                                <label><?php echo read_xmls('/site/mailmessage/lables/subject') ?></label>
                               <input class="form-control" name="subject" type="text" id="subject" value="<?php echo check_var("subject", "POST"); ?>" maxlength="255"/>
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/mailmessage/lables/content') ?></label>
                                <?php
                                $getValue = check_var("content", "POST");
                                $getField = 'content';
                                $getBaseFolder = '../../aids/ckeditor/';
                                $getType = 'larg';
                                include('../../aids/editor.php');
                                ?>
                            </div>

                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/send') ?>" />
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
