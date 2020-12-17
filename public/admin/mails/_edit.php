<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$mail = Mail::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }  
    $mails = new Mail();
    $mails->id = $_GET['id'];
    @$mails->email = trim($_POST['email']);
    @$mails->mobile = trim($_POST['mobile']);
    @$mails->mail_groups_id = trim($_POST['mail_groups_id']);
    @$mails->publish = $mail->publish;
    @$mails->created = $mail->created;
    @$mails->updated = current_date();

    if ($mails->save_mail($mail->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Mail: {$mails->email} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $mail->id);
    } else {
        $message = join("<br/>", $mails->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/mail/titles/edit') ?>: <?php echo $mail->email; ?></h2>
                <a class=" btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/mail/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="mail" action="_edit.php?id=<?php echo $mail->id; ?>" method="POST" enctype="multimail/form-data">
                          <?php echo setToken() ?>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/mail/lables/name') ?></label>
                                    <input  class="form-control" type="text" name="email" value="<?php echo $mail->email; ?>" maxlength="255" />
                                    <?php echo read_xmls('/site/mail/lables/charnum') ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/mail/lables/mobile') ?></label>
                                    <input  class="form-control" name="mobile" type="text" id="mobile" value="<?php echo $mail->mobile; ?>" maxlength="12"  onkeypress='return isNumberKey(event)'/>
                                         =&gt; 966544330099
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/mailgroup/titles/main') ?></label>
                                    <select  class="form-control" name="mail_groups_id">
                                        <?php
                                        //Get all MailGroups
                                        $mains = MailGroup::find_all("title ASC","WHERE site_id={$session->site_id}");
                                        foreach ($mains as $main):
                                            ?>
                                            <option value='<?php echo $main->id; ?>'<?php if ($mail->mail_groups_id == $main->id) {
                                            echo ' selected';
                                        } ?>><?php echo $main->title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <div class="form-group">

                                     <?php if ($session->has_permission('MainCategoryTranslate')) { ?>
                                        <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="btn btn-primary"/>
                                     <?php } ?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
