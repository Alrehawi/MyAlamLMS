<?php

require_once("../../includes/initialize.php");
global $session;
$text = rand(10000, 99999);
$session->captcha($text);
$height = 25;
$width = 58;
$image_p = imagecreate($width, $height);
$black = imagecolorallocate($image_p, 0, 0, 0);
$white = imagecolorallocate($image_p, 255, 255, 255);
$font_size = 17;
imagestring($image_p, $font_size, 5, 5, $text, $white);
imagejpeg($image_p, null, 80);
?> 