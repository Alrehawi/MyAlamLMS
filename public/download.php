<?php require_once("../includes/initialize.php"); ?>
<?php echo include_layout_template('header.php'); ?>
<?php

$file = $_GET['file'];
//echo FILE_PATH.DS.$file;
if (file_exists(FILE_PATH . DS . $file)) {
    echo download(FILE_PATH . DS . $file);
} else {
    echo read_xmls('/site/msg/filenotfound');
    echo "<br />";
    echo "<a href='javascript:history.back(-1);'>" . read_xmls('/site/adminactions/back') . "</a>";
}
?>
<?php include_layout_template('footer.php'); ?>