<?php

//TimeZone
date_default_timezone_set('Asia/Riyadh');

//Debuging control
ini_set('display_errors', '2');
error_reporting(E_ALL | E_STRICT);

//echo $_SERVER['REMOTE_ADDR'];exit;
//DataBase Configuration

if ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == "::1") {
    defined('DB_SERVER') ? null : define("DB_SERVER", "127.0.0.1");
    defined('DB_USER') ? null : define("DB_USER", "root");
    defined('DB_PASS') ? null : define("DB_PASS", "");
    defined('DB_NAME') ? null : define("DB_NAME", "afsch2");
    defined('HTTP') ? null : define("HTTP", "http://");

} else { //server
  defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
  defined('DB_USER') ? null : define("DB_USER", "sasbit_usr");
  defined('DB_PASS') ? null : define("DB_PASS", "SasbitUser123");
  defined('DB_NAME') ? null : define("DB_NAME", "sasbit_wmn");
  defined('HTTP') ? null : define("HTTP", "https://");
}

//Main Configurations
defined('SUB_FOLDER') ? null : define('SUB_FOLDER', 'public'); //sub folder path

defined('ADMIN') ? null : define('ADMIN', 'admin'); //admin path

defined('ADMIN_EMAIL') ? null : define('ADMIN_EMAIL', ''); //admin email

defined('BCC_EMAIL') ? null : define('BCC_EMAIL', ''); // other bcc email

defined('TO_EMAIL') ? null : define('TO_EMAIL', ''); // other bcc email

defined('SITE_ROOTDSO') ? null : define('SITE_ROOTDSO', stristr(__DIR__, 'includes', true));

defined('FILE_RELATIVE') ? null : define('FILE_RELATIVE', HTTP . $_SERVER['HTTP_HOST'] . stristr(dirname($_SERVER['SCRIPT_NAME']), DS . SUB_FOLDER, true) . DS . SUB_FOLDER);

$subfolder = str_replace('/'.SUB_FOLDER,'',dirname($_SERVER['SCRIPT_NAME']));
if(substr($subfolder,-1)=='/'){
$subfolder = rtrim($subfolder, "/");
}
defined('FILE_RELATIVES') ? null : define('FILE_RELATIVES', HTTP . $_SERVER['HTTP_HOST'] . $subfolder . DS . SUB_FOLDER);

defined('FILE_RELATIVE_ROOT') ? null : define('FILE_RELATIVE_ROOT', HTTP . $_SERVER['HTTP_HOST'] . $subfolder);

defined('FILE_PATH') ? null : define('FILE_PATH', SITE_ROOTDSO . SUB_FOLDER);

defined('FILE_PATHDSO') ? null : define('FILE_PATHDSO', SITE_ROOTDSO . DSO . SUB_FOLDER);
?>
