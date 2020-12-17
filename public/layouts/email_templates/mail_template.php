<?php

global $Subject, $content, $msg, $To, $direction;
if ($direction == 'rtl') {
    $align = 'right';
} else {
    $align = 'left';
}
$msg = "<div style='margin:0 auto; width:630px; background:#ffffff; border:#d4cdbb solid 1px; padding: 20px;' dir='" . $direction . "'>";
$msg.="<div style='margin:0 auto;width:620px;'>";
$msg.="<div align='" . $align . "'>";
$msg.="<a href='" . FILE_RELATIVE . DS . "' target='_blank'>";
$msg.="<img src='" . FILE_RELATIVE . DS . 'images' . DS . 'img' . DS . 'logo.png' . "' height='100' border='0' />";
$msg.="</a>";
$msg.="</div>";
$msg.="</div>";
$msg.="<div style='margin:0 auto;width:612; padding:10px; clear:both'>";
$msg.="</div>";
$msg.="<div style='margin:0 auto;width:620;background:#FFFFFF;'>";
$msg.="<div style='width:610px; margin:0 5px;'>";
$msg.="<div style='padding:10px;border-bottom:#d4cdbb solid 1px; text-align:" . $align . ";' dir='" . $direction . "'>";
$msg.="<h3 style='color:#a8c829; font-weight:bold; font-family:Tahoma;'>" . $Subject . "</h3>";
$msg.="</div>";
$msg.="<div style='padding:10px;text-align:" . $align . ";'>";
$msg.="<div>" . $content . "</div>";
$msg.="</div>";
$msg.="</div>";
$msg.="</div>";
$msg.="</div>";
/* echo $msg;
  exit; */
?>