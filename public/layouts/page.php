<?php
global $database,$session,$layout_type,$layout_type_id;
$page=Page::find_by_field('url_alias',$database->escape_value($_GET['page']));
$page=$page[0]->id;

//check for sending page value by URL
if(!isset($page)){
	$session->message(read_xmls('/site/msg/selectitem'));
	redirect_to(FILE_RELATIVES.DS.'error.php?e=page_item_not_found');
}
$chcek_value = new Page ();
$published = Page::find_field_by_id('publish' , $page);
//check for valid page sent by URL || check publish page
if(!$chcek_value->check_entry($page , 'id') || !$published){
	$session->message(read_xmls('/site/msg/notvalid'));
	redirect_to(FILE_RELATIVES.DS.'error.php?e=page_item_not_valid');
}

/*if(!Layout::count_by_field('page_id',$page)){
	$session->message(read_xmls('/site/frontend/msg/nolayout'));
	redirect_to(Page::get_home_link());
}*/

$layout_type="page_id"; // Page or Module?
$layout_type_id=$page; // Id of wanted type
echo include_layout_template('layout.php');
?>
