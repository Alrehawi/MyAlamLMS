<?php require_once("../includes/initialize.php"); ?>
<?php

global $database, $session, $Subject, $content, $To, $msg, $direction;
@sanitizePostVal($_POST['name']);
@sanitizePostVal($_POST['phone']);
@sanitizePostVal($_POST['email']);
@sanitizePostVal($_POST['msg']);
if (empty($_POST['name']) ||
        empty($_POST['phone']) ||
        empty($_POST['email']) ||
        empty($_POST['msg']) ||
        empty($_POST['captcha'])
) {

    echo output_message(read_xmls('/site/msg/allrequire'));
} else if ($_POST['captcha'] != $session->captcha || empty($session->captcha)) {
    echo output_message(read_xmls('/site/frontend/contact/msg/captchaerror'));
} else {
  if(!checkToken($_POST['_token'])){
    echo output_message(read_xmls('/site/msg/invalidsubmit'));

  } else{


    $date = date("Y/m/d h:i:s A");
    $ip = getenv("REMOTE_ADDR");
    //insert to db
    @$contacts = new Contacts();
    @$contacts->name = trim($_POST['name']);
    @$contacts->phone = trim($_POST['phone']);
    @$contacts->email = trim($_POST['email']);
    @$contacts->msg= trim($_POST['msg']);
    @$contacts->created = current_date();
    @$contacts->visitor_ip = $ip;
    @$contacts->site_id = $session->site_id;

    if($contacts->save()){
      echo log_action("Add New Contact us request: {$contacts->name} " , "By: Visitor");
      //send confirmation email

      $direction = read_xmls('/site/config/dir');
      $Subject = SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key) . ' :: ' . read_xmls('/site/frontend/contact/msg/subject');
      $To = SiteConfig::site_config('email');

      $From = trim($_POST['email']);
      $content = "
  		<h2>" . $Subject . "</h2>
  		<div dir='" . read_xmls('/site/config/dir') . "'><b>" . read_xmls('/site/frontend/contact/lables/name') . ":</b> " . $_POST['name'] . "</div>
  		<div dir='" . read_xmls('/site/config/dir') . "'><b>" . read_xmls('/site/frontend/contact/lables/email') . ":</b> " . $_POST['email'] . "</div>
  		<div dir='" . read_xmls('/site/config/dir') . "'><b>" . read_xmls('/site/frontend/contact/lables/phone') . ":</b> " . $_POST['phone'] . "</div>
  		<div dir='" . read_xmls('/site/config/dir') . "'><b>" . read_xmls('/site/frontend/contact/lables/msg') . ":</b> <div style='margin-" . read_xmls('/site/config/align') . ":60px;'>" . nl2br($_POST['msg']) . "</div></div>
  		<div dir='" . read_xmls('/site/config/dir') . "'><b>" . read_xmls('/site/frontend/contact/lables/date') . ":</b> " . $date . "</div>
  		<div dir='" . read_xmls('/site/config/dir') . "'><b> " . read_xmls('/site/frontend/contact/lables/ip') . " :</b> " . $ip . "</div>
  	";

      //get template
      echo include_layout_template('email_templates/mail_template.php');
      $MailMsg = $msg;
      //echo $MailMsg;exit;
      $SucMsg = read_xmls('/site/frontend/msg/sentsuccess');
      $ErrorMsg = read_xmls('/site/frontend/msg/cantsendemail');
      $Cc = '';
      $Bcc = BCC_EMAIL;
      echo @SendMail($To, $From, $Subject, $MailMsg, $SucMgs, $ErrorMsg, $Cc, $Bcc);
      $session->message($SucMsg);
      redirect_to("./?" . $_POST['redirect']);
    } else {
        echo output_message(read_xmls('some_error_occurred'));
    }
  }
}
?>
