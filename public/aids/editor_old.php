<?php

require_once("../../../includes/initialize.php");

// Include the CKEditor class.
include('ckeditor/ckeditor.php');

// Create a class instance.
$CKEditor = new CKEditor();

// Do not print the code directly to the browser, return it instead.
$CKEditor->returnOutput = true;

// Path to the CKEditor directory, ideally use an absolute path instead of a relative dir.
//   $CKEditor->basePath = '/ckeditor/'
// If not set, CKEditor will try to detect the correct path.
$CKEditor->basePath = $getBaseFolder;

// Set global configuration (will be used by all instances of CKEditor).
$CKEditor->config['width'] = '85%';
$CKEditor->config['height'] = 400;

// Change default textarea attributes.
$CKEditor->textareaAttributes = array("cols" => 150, "rows" => 15);

// The initial value to be displayed in the editor.
$initialValue = $getValue;

//Run the editor

if ($getType == 'larg') {

    // Create the first instance.
    $code = $CKEditor->editor($getField, $initialValue);

    echo $code;
} else {

    // Configuration that will only be used by the second editor.
    $config['toolbar'] = array(
        array('Source', '-', 'Bold', 'Italic', 'Underline', 'Strike'),
        array('Image', 'Link', 'Unlink'),
        array('NumberedList', 'BulletedList'),
        array('TextColor', 'Styles', 'RemoveFormat'),
        array('Preview', 'language')
    );

    $config['skin'] = 'v2';

    // Create the second instance.
    echo $CKEditor->editor($getField, $initialValue, $config);
}
?>
