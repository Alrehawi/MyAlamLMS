<?php

header('Content-type: text/css');
require_once('../../includes/initialize.php');
$align = read_xmls('/site/config/align');
$otheralign = read_xmls('/site/config/otheralign');
$menu_margin = read_xmls('/site/config/menu_margin');
$general_font = read_xmls('/site/config/font');
$thisPadding = read_xmls('/site/config/paddings');

echo ("
@import url('ar_font.css');
html {  direction:" . Language::current_lang_attribute('direction') . "; }
body { height: 100%; width: 100%; margin: 0; padding: 0; border: 0; background: #FFFFFF;
  font: " . $general_font . "; }
img { border: none; }
table, tr, td, tr { border-collapse:0;
  font:" . $general_font . "; margin:20px 0 20px 0; clear:both;}

th {
	background:url(../back_images/buttons.png);
 repeat-x top;color:#06465B;border-radius:4px;-moz-border-radius:4px;font-weight:600;-webkit-box-shadow:0 1px 2px #999;-moz-box-shadow:0 1px 2px #999;box-shadow:0 1px 2px #999;text-shadow:1px 1px 1px #70CAE8;padding:6px 10px; margin:10px;
}
td{	height:30px; vertical-align:top; padding-top:10px;}
tr{	background-color:#ffffff;}
tr:hover{	background-color:#ffffcc;}
a { color: #8D0D19; text-decoration:none;}
a:hover {text-decoration: underline;}

#header { height: 50px; background: #102f51; color: #D4E6F4; padding-bottom:20px; }
#header h1 { padding: 1em; margin:0px; }
#header h1 a{ color: #fff; font-size:16px; padding-bottom:20px;}
/* Note: IE 5 & 6 won't understand min-height */
#main { min-height: 300px; background: #ffffff; padding: 2em;}
.message {	width:400px;	border: 1px dashed;	margin: 10px 0px;	padding:15px 10px 15px 50px;	background-repeat: no-repeat;	background-position: 10px center;	color: #9F6000;	background-color: #FEEFB3;	background-image: url('../back_images/message.png');}
.yellowbox{	padding-top:2px !important;	background-image:url(../images/img/basic_icons/warning_32.png);	background-repeat:no-repeat;	background-position:20px 50%;	height:30px;	background-color:#fef893;	margin:10px 0 0 10px;	}
.yellowbox h2{	font-size:13px;	font-family: 'PT Sans', sans-serif;			color:#5b5430;	text-shadow:0 0 0 transparent,#ffffff 0px 1px 0px;	margin-left:70px;}
#langs { padding-right:20px;padding-" . $align . ":20px;}
#footer { clear:both;  padding: 1em; text-align: center;   background: #1A446C;  color: #D4E6F4; position: fixed;  bottom: 0px;   left: 0px;   right: 0px;   margin-bottom: 0px;}
table.bordered tr th, table.bordered tr td { border: 1px solid #000000; }

#pagination{margin-bottom:20px;display: inline-block;}
#pagination a {    color: black;    float: " . $align . ";    padding: 8px;    text-decoration: none;border: 1px solid #ddd;  border-radius: 5px; margin:2px;}
#pagination .paging_cur{color: black;    float: " . $align . ";    padding: 8px;    text-decoration: none;border: 1px solid #ddd;  border-radius: 5px; margin:2px;background-color: #1A446C;    color: white;}
#pagination a:hover:not(.paging_cur) {background-color: #ddd;}

.permission_td{	padding-" . $align . ":40px;}

/*MENU----------------------------------------------------*/
.menu-primary-wrapper {	width: 100%;	height: 50px;	background: url(../back_images/menu-primary-wrapper-bg.png) bottom " . $align . " repeat-x;clear: both;}
.menu-primary {	 margin: 0 auto;}
.menu-primary ul {	margin: 0;	list-style: none;}
.menu-primary li {	list-style-type: none;	background: url(../back_images/menu-item-border.png) center " . $align . " no-repeat;	position: relative;	float: " . $align . ";}
.menu-primary li:hover > a {	background: url(../back_images/menu-item-act.png) center " . $align . " no-repeat;	color: #56c3e2;	text-shadow: #252525 0 1px 0;}
.menu-primary li:hover > a span {	background: url(../back_images/ico-bullet-blue-1.png) {$otheralign} 6px no-repeat;	padding: {$thisPadding};}
.menu-primary ul ul {	position: absolute;	top: 49px;	" . $align . ": -4px;	width: 224px;	background: url(../back_images/jqueryslidemenu-bg.png) bottom center no-repeat;	padding: 0 0 9px 0;	float: read_xmls('/site/config/align');	display: none;	z-index: 103;}
.menu-primary ul ul ul {	position: absolute;	top: 0px;	" . $align . ": 216px;	width: 224px;	background: url(../back_images/jqueryslidemenu-bg.png) bottom center no-repeat;	padding: 0 0 9px 0;	float: " . $align . ";	display: none;	z-index: 100;}
.menu-primary ul li:hover > ul {	display: block;}
.menu-primary .menu-item a {	margin: " . $menu_margin . ";	text-align: center;	font-size: 15px;	font-weight: normal;	color: #fff;	text-decoration: none;	text-shadow: #000 0 1px 0;	display: block;	position: relative;	z-index: 1;}
.menu-primary .menu-item a i {	padding: 15px 21px 0 21px;	height: 35px;	font-style: normal;	background: url(../back_images/menu-item-border.png) center right no-repeat;	display: block;}
.menu-primary .menu-item a span {	background: url(../back_images/ico-bullet-1.png) {$otheralign} 6px no-repeat;	padding: {$thisPadding};}
.menu-primary ul ul .menu-item a span {	background: url(../back_images/ico-bullet-1.png) {$otheralign} 3px no-repeat;	padding: {$thisPadding};}
.menu-primary .menu-item a:hover {	margin: " . $menu_margin . ";	background: url(../back_images/menu-item-act.png) center " . $align . " no-repeat;	text-align: center;	font-weight: normal;	color: #56c3e2;	text-decoration: none;	text-shadow: #000 0 1px 0;	display: block;	position: relative;	z-index: 1;}
.menu-primary .menu-item a:hover span {	background: url(../back_images/ico-bullet-blue-1.png) {$otheralign} 6px no-repeat;	padding: {$thisPadding};}
.menu-primary ul ul .menu-item a:hover span {	background: url(../back_images/ico-bullet-1.png) {$otheralign} 3px no-repeat;	padding: {$thisPadding};}
.menu-primary ul ul .menu-item a {	width: 164px;	height: auto;	padding: 11px 25px 10px 25px;	margin: 0 5px;	border: none;background: url(../back_images/jqueryslidemenu-sub-level-bg.png) top " . $align . " repeat-x;	color: #fff;	font-size: 14px;	font-weight: normal;	text-align: " . $align . ";	text-shadow: #252525 0 1px 0;	text-decoration: none;	display: block;}
.menu-primary ul ul .menu-item a i {	padding: 0;	height: auto;	font-style: normal;	background: none;	display: inline;}
.menu-primary ul ul .menu-item a:hover {	width: 164px;	height: auto;	padding: 11px 25px 10px 25px;	margin: 0 5px;	border: none;	background: #102f51 url(../back_images/jqueryslidemenu-sub-level-bg.png) top " . $align . " repeat-x;	color: #fff;	font-size: 14px;	font-weight: normal;	text-align: " . $align . ";	text-shadow: #252525 0 1px 0;	text-decoration: none;	display: block;}
.menu-primary ul ul li {	background: none;}
.menu-primary ul ul li:hover > a {	background: #102f51 url(../back_images/jqueryslidemenu-sub-level-bg.png) top " . $align . " repeat-x;	color: #fff;	text-shadow: #252525 0 1px 0;}
/*Layout----------------------------------------------------*/
	#dhtmlgoodies_dragDropContainer{width:1000px;background-color:#FFF;	-moz-user-select:none;	}
	#dhtmlgoodies_dragDropContainer ul{margin-top:0px;margin-left:0px;margin-bottom:0px;padding:2px;}
	#dhtmlgoodies_dragDropContainer li,#dragContent li,li#indicateDestination{list-style-type:none;	height:20px;	border:1px solid #000;	padding:5px;	margin: 0 0 5px 0;	cursor:move;	font-size:12px;border:1px solid #AEAEAE;background-image:url(../back_images/plug-bg.png);background-repeat:repeat;border-radius:5px;box-shadow:0 0 4px #ccc;padding:6px}
	li#indicateDestination{	border:1px solid #fff;background-color:#FFF;border:1px solid #AEAEAE;background-image:url(../back_images/layout-bg.png);background-repeat:repeat;border-radius:5px;box-shadow:0 0 4px #ccc;padding:6px}
	div#dhtmlgoodies_listOfItems{float:" . $align . ";padding: 8px 0 0 0;
	/* CSS HACK */	width: 180px;	/* IE 5.x */	width/* */:/**/160px;	/* Other browsers */	width: /**/160px;	}
	#dhtmlgoodies_listOfItems ul{	height:560px;}
	div#dhtmlgoodies_listOfItems div{		width:230px;	}
	div#dhtmlgoodies_listOfItems div ul{margin-left:10px;}
	#dhtmlgoodies_listOfItems div p{margin:0px;text-align:center;font-weight:bold;padding-left:12px;margin-bottom:5px;}
	#dhtmlgoodies_dragDropContainer .mouseover{	}
	div#dhtmlgoodies_mainContainer{		width:750px;		float:" . $otheralign . ";	}
	#dhtmlgoodies_mainContainer div{		margin:0 0 10px 0;		border:1px solid #AEAEAE;background-image:url(../back_images/layout-bg.png);background-repeat:repeat;border-radius:5px;box-shadow:0 0 4px #ccc;padding:6px	}
	#dhtmlgoodies_mainContainer #main-position{height:170px;width:140px;background:url(../back_images/main-position.png) no-repeat center center !important; float:" . $align . "; margin-" . $align . ":10px!important; border:none!important;box-shadow:0px!important;border-radius:0!important; padding:0 10px;}
	#dhtmlgoodies_mainContainer div ul{		margin-left:10px;	}
	#dhtmlgoodies_mainContainer #topDIV{margin-top:10px;/* CSS HACK */width: 735px;	/* IE 5.x */width/* */:/**/735px;	/* Other browsers */width: /**/735px;}
	#dhtmlgoodies_mainContainer #leftDIV{clear:both;float:" . $align . ";/* CSS HACK */width: 272px;	/* IE 5.x */width/* */:/**/270px;	/* Other browsers */width: /**/270px;}
	#dhtmlgoodies_mainContainer #rightDIV{		float:" . $otheralign . ";		/* CSS HACK */		width: 272px;	/* IE 5.x */		width/* */:/**/270px;	/* Other browsers */		width: /**/270px;	}
	#dhtmlgoodies_mainContainer #bottomDIV{		clear:both;		/* CSS HACK */		width: 735px;	/* IE 5.x */		width/* */:/**/735px;	/* Other browsers */		width: /**/735px;		}

	#dhtmlgoodies_mainContainer ul{	width:230px;height:80px;border:0px;margin-bottom:0px;overflow:hidden;	}

	#dragContent{position:absolute;	width:230px;height:20px;display:none;margin:0px;padding:0px;z-index:2000;}
	#dragDropIndicator{	position:absolute;width:7px;height:25px;display:none;z-index:1000;margin:0px;padding:20px 0px;}
	#footer_layout{	padding-top:30px;	clear: both; margin-bottom:20px;}

/* FORM Style-----------------------------------------------*/
input,textarea,.inputbox-sml,select{font:" . $general_font . ";font-size:13px;background-color:#FFF;border:1px solid #B8B8B8;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;padding:5px;outline:none;}

.button,.button-alt,.button-sml,.button-alt-sml{background:url(../back_images/buttons.png) repeat-x top;border:1px solid #0D87AE!important;color:#06465B;border-radius:4px;-moz-border-radius:4px;font-weight:600;-webkit-box-shadow:0 1px 2px #999;-moz-box-shadow:0 1px 2px #999;box-shadow:0 1px 2px #999;text-shadow:1px 1px 1px #70CAE8;padding:3px 10px}
.button-sml,.button-alt-sml{border-radius:3px;-moz-border-radius:3px;font-size:12px;padding:4px 8px;text-shadow:1px 1px 2px #70CAE8;}
.button:hover,.button-sml:hover{background:url(../back_images/buttons.png) 0 -50px;border:1px solid #005977;cursor:pointer;text-decoration:none;color:#000}
select{width:270px;color:#333333; max-height:35px;}
textarea,input[type='text'],input[type='password'],input[type='file']{width:259px;color:#333333;}
.border {margin: 1px; background-color:#ffffff; padding: 1em; border:1px solid #eeeeee;}
.date{font-size:12px; color:#999999; font-style:italic}
.navigat{float:" . $align . "; width:600px;}
.search {float:" . $otheralign . ";}

#result {	height:20px;	font-size:16px;	color:#333;	padding:5px;margin-bottom:10px;	background-color:#FFFF99;}
.suggestionsBox {	position: absolute;	" . $align . ": 0px;	top:5px;	margin: 26px 0px 0px 0px;width: 200px;	padding:0px;background-color: #000;	border-top: 3px solid #000;	color: #fff;z-index:100;}
.suggestionList {	margin: 0px;	padding: 0px;}
.suggestionList ul li {	list-style:none;	margin: 0px;	padding: 6px;	border-bottom:1px dotted #666;	cursor: pointer;}
.suggestionList ul li:hover {	background-color: #FC3;	color:#000;}
.suggestionList ul {font-size:11px;	color:#FFF;	padding:0;	margin:0;}
.load{background-image:url(../back_images/loader.gif);background-position:" . $otheralign . ";background-repeat:no-repeat;}
#suggest {position:relative;}
.cli{background-color:#ffffcc;}
.cli td{border-radius:5px;-moz-border-radius:5px;}
.plugin_cont{ max-height:560px; overflow-y:auto;}
.short_desc{width:588px !important; height:100px;}
.small{font-size: 10px; color: #ccc;}
.file_uploading {    margin-top: 15px;}
#hidden {    display: none;}
.gallery {	width:100%;	float:left;}
.gallery ul{	margin:0;	padding:0;	list-style-type:none;}
.gallery ul li{	padding:7px;	border:2px solid #ccc;	float:left;	margin:10px 7px;	background:none;	width:auto;	height:auto;}
.images {	height:100px;}
");
?>
