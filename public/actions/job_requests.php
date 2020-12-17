<?php require_once("../../includes/initialize.php");
global $database,$session,$Subject,$content,$To,$msg,$direction;

$data = array();
foreach($_POST["fields"] as $key => $value){
		if(is_array($value)){
				$value = implode(" ,", $value);
		}
		$data[$key] = $value;
}

if($_POST['captcha'] != $session->captcha || empty($session->captcha)){
	echo output_message();
	$output = array("success" => 0,
			"error" => "error",
			"msg" => read_xmls('/site/frontend/contact/msg/captchaerror'),
			"data" => $data
	);
} else {

	 $_POST=$data;
	@$jrs = new JobRequest();
	@$jrs->full_name = trim($_POST['full_name']);
	@$jrs->gender = trim($_POST['gender']);
	@$jrs->mobile = trim($_POST['mobile']);
	@$jrs->email = trim($_POST['email']);
	@$jrs->file_id= trim($_POST['file_id']);
	@$jrs->notes = trim($_POST['notes']);
	@$jrs->created = current_date();

	if($jrs->save()){
		echo log_action("Add New Job Request: {$jrs->full_name} " , "By: Visitor");
		//send confirmation email
		$date= date("Y/m/d h:i:s A");
		$ip = getenv ("REMOTE_ADDR");
		$To=SiteConfig::site_config('email');
		$Subject= SiteConfig::find_viewed_language('title' , 1 , SiteConfig::$trans_key).' :: '.read_xmls('/site/frontend/jobrequest/subject');
		$direction=read_xmls('/site/config/dir');
		$From=trim($_POST['email']);
		$content="
			<h2>".$Subject."</h2>
			<div dir='".read_xmls('/site/config/dir')."'><b>".read_xmls('/site/frontend/contact/lables/name').":</b> ".$_POST['full_name']."</div>
			<div dir='".read_xmls('/site/config/dir')."'>".read_xmls('/site/frontend/jobrequest/note')."</div>
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
		//$session->message($sucuadd);
    //redirect_to("./?" . $_POST['redirect']);
		$output = array("success" => 1,
				"redirect" => 0,
				"msg" => $sucuadd,
				"data" => $data
		);
		echo json_encode($output); exit;
	} else {
		$output = array("success" => 0,
		    "error" => "Email error",
		    "msg" => "Something went wrong, please try again.",
		    "data" => $data
		);
	}


}
echo json_encode($output); exit;
?>
