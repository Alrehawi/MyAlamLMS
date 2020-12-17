<?php require_once("../includes/initialize.php");
global $database,$session,$Subject,$content,$To,$msg,$direction;

if($_POST['captcha'] != $session->captcha || empty($session->captcha)){
	echo output_message(read_xmls('/site/frontend/contact/msg/captchaerror'));
} else {
	@$jrs = new JoinRequest();
	@$jrs->full_name = trim($_POST['full_name']);
	@$jrs->gender = trim($_POST['gender']);
	@$jrs->birth_date = trim($_POST['birth_date']);
	@$jrs->nationality = trim($_POST['nationality']);
	@$jrs->mobile = trim($_POST['mobile']);
	@$jrs->email = trim($_POST['email']);
	@$jrs->id_no = trim($_POST['id_no']);
	@$jrs->address = trim($_POST['address']);
	@$jrs->photo = trim($_POST['photo']);
	@$jrs->stage_no = trim($_POST['stage_no']);
	@$jrs->level_no = trim($_POST['level_no']);
	@$jrs->category_id = trim($_POST['category_id']);
	@$jrs->parent_full_name = trim($_POST['parent_full_name']);
	@$jrs->parent_id_no = trim($_POST['parent_id_no']);
	@$jrs->parent_mobile = trim($_POST['parent_mobile']);
	@$jrs->parent_email = trim($_POST['parent_email']);
	@$jrs->created = current_date();

	if($jrs->save()){
		echo log_action("Add New Join Request: {$jrs->full_name} " , "By: Visitor");
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
		echo "<span class='red'>".join("<br/>",$jrs->errors)."</span>";
	}
}
?>
