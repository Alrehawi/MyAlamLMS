<?php require_once("../includes/initialize.php");
global $database,$session,$Subject,$content,$To,$msg,$direction;

if(empty($_POST['full_name'])
	|| empty($_POST['birth_date'])
	|| empty($_POST['profession'])
	|| empty($_POST['nationality'])
	|| empty($_POST['tel'])
	|| empty($_POST['mobile'])
	|| empty($_POST['email'])
	|| empty($_POST['country'])
){
	echo "<span class='red'>".read_xmls('/site/msg/allrequire')."</span>";

} else if($_POST['captcha'] != $session->captcha || empty($session->captcha)){
	echo output_message(read_xmls('/site/frontend/contact/msg/captchaerror'));
} else {
	@$subs = new Subscription();
	@$subs->full_name = trim($_POST['full_name']);
	@$subs->gender = trim($_POST['gender']);
	@$subs->birth_date = trim($_POST['birth_date']);
	@$subs->profession = trim($_POST['profession']);
	@$subs->nationality = trim($_POST['nationality']);
	@$subs->tel = trim($_POST['tel']);
	@$subs->mobile = trim($_POST['mobile']);
	@$subs->email = trim($_POST['email']);
	@$subs->country = trim($_POST['country']);
	@$subs->program = trim($_POST['program']);
	@$subs->interests = trim($_POST['interests']);
	@$subs->created = current_date();

	if($subs->save()){
		echo log_action("Add New Subscription: {$subs->full_name} " , "By: Visitor");
		//send confirmation email
		$date= date("Y/m/d h:i:s A");
		$ip = getenv ("REMOTE_ADDR");
		$To=SiteConfig::site_config('email');
		$Subject= SiteConfig::find_viewed_language('title' , 1 , SiteConfig::$trans_key).' :: '.read_xmls('/site/frontend/subscription/subject');
		$direction=read_xmls('/site/config/dir');
		$From=trim($_POST['email']);
		$content="
			<h2>".$Subject."</h2>
			<div dir='".read_xmls('/site/config/dir')."'><b>".read_xmls('/site/frontend/contact/lables/name').":</b> ".$_POST['full_name']."</div>
			<div dir='".read_xmls('/site/config/dir')."'>".read_xmls('/site/frontend/subscription/note')."</div>
			<div dir='".read_xmls('/site/config/dir')."'><b>".read_xmls('/site/frontend/contact/lables/date').":</b> ".$date."</div>
			<div dir='".read_xmls('/site/config/dir')."'><b> ".read_xmls('/site/frontend/contact/lables/ip')." :</b> ".$ip."</div>
		";
		//get template
		echo include_layout_template('email_templates/mail_template.php');
		$MailMsg=$msg;
		//echo $MailMsg;exit;
		$SucMsg=read_xmls('/site/frontend/msg/sentsuccess');
		$ErrorMsg=read_xmls('/site/frontend/msg/cantsendemail');
		$Cc='';
		$Bcc=BCC_EMAIL;
		echo @SendMail($To , $From , $Subject , $MailMsg , $SucMgs , $ErrorMsg , $Cc , $Bcc);
		$sucuadd=read_xmls('/site/msg/sucuadd');
		$session->message($sucuadd);
    redirect_to("./?" . $_POST['redirect']);
	} else {
		echo "<span class='red'>".join("<br/>",$subs->errors)."</span>";
	}
}
?>
