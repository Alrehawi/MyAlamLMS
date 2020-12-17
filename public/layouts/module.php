<?php

global $database, $layout_type, $layout_type_id;
$module = Module::find_by_field('url_alias', $database->escape_value($_GET['module']));
$module = $module[0]->id;
//check for sending module value by URL
if (!isset($module)) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to(FILE_RELATIVES.DS.'error.php?e=module_item_not_found');
}
$chcek_value = new Module();
$published = Module::find_field_by_id('publish', $module);
//check for valid module sent by URL || check publish module
if (!$chcek_value->check_entry($module, 'id') || !$published) {
    $session->message(read_xmls('/site/msg/notvalid'));
    redirect_to(FILE_RELATIVES.DS.'error.php?e=module_item_not_valid');
}

$layout_type = "module_id"; // Page or Module?
$layout_type_id = $module; // Id of wanted type
echo include_layout_template('layout.php');
?>
