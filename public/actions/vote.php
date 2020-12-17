<?php require_once("../../includes/initialize.php");
if(isset($_POST['id']) && isset($_POST['voteQ'])){
	global $database;
	$vote=new Vote();
	$vote->poll_id=$_POST['voteQ'];
	$id=$database->escape_value($_POST['id']); 
	$ip=$_SERVER['REMOTE_ADDR'];
	$_POST['poll_answer']=$id;
	$vote->votePoll();
	$vote->writePoll();
}
?>
