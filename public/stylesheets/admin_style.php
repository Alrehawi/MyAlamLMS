<?php

header('Content-type: text/css');
require_once('../../includes/initialize.php');
$align = read_xmls('/site/config/align');
$otheralign = read_xmls('/site/config/otheralign');
$menu_margin = read_xmls('/site/config/menu_margin');
$general_font = read_xmls('/site/config/font');
$thisPadding = read_xmls('/site/config/paddings');

echo ("

html {  direction:" . Language::current_lang_attribute('direction') . "; }
body{font-family: 'myFirstFont' !important;}
img { border: none; }
th:last-child::after { display: none !important; }
#cke_offline_msg, #cke_content{
    width: 100% !important
}
ul.dropdown-menu:lang(ar), .filter-option:lang(ar) {
    text-align: right !important
}
ul.dropdown-menu:lang(en), .filter-option:lang(en) {
    text-align: left !important
}


.margin-right-fivePx:lang(en) {
    margin-left: 5px !important
}



#side-menu {
    padding-right: 0 !important;
}
.sidebar {

}
.navbar-toggle:lang(en) {
    float: left !important;
    margin-left: 5px;
}

.dataTables_paginate{
    float: right !important
}
.permissions input {
    margin : 5px !important
}
.permission input {
    margin : 5px !important
}
tr, th {
	outline: none !important;
}
th:hover {
	cursor: pointer
}
input[type=checkbox], input[type=radio]{
width:20px !important;
height:20px!important;
}
input:hover{
	cursor: pointer
}
input[type='radio'] {
    margin: 10px !important
}

.fa fa-table fa-fw {
	margin-left: 15px
}

h1{
	font-size: 20px !important;
    font-weight: bold!important;
}
.col-xs-3 i{
    position: relative;
    left: 40px
}

#side-menu .input-group-btn button:lang(ar){
    border-radius: 0 !important;
    border-left: 0;
}
#side-menu .input-group-btn button i:lang(en){
    padding: 4px
}
#side-menu input:lang(ar) {
    border-radius: 0
}
.navbar-top-links:lang(en) {
    position: absolute;
    right: 5px !important;
    top: 0 !important
}
.navbar-brand:lang(en) {
    position: absolute;
    left: 5px !important
}
.navbar-brand img{
    position: relative;
    top: -15px;
    margin-top:5px;
}
.navbar-brand span{
    position: relative;
    top: -8px;
}
.navbar-top-links .dropdown-menu:lang(en) {
    left: auto !important
}
.navbar-top-links .dropdown-menu:lang(ar) {
    text-align: right
}

.navbar-top-links .user-menu:lang(en) {
  right: 0 !important;
}

.pull-right:lang(ar) {
    float: left !important
}
.login_logo{background:#fff; width:80%;border-radius:10px; margin:10px; }
.logoDashboard{background:#fff; width:auto;border-radius:10px; margin: 0 10px 10px 10px ; text-align:center;}
 .logoDashboard  img ,.login_logo img{width:95%; margin:10px 0;}
#pagination{margin-bottom:20px;display: inline-block;}
#pagination a {    color: black;    float: " . $align . ";    padding: 8px;    text-decoration: none;border: 1px solid #ddd;  border-radius: 5px; margin:2px;}
#pagination .paging_cur{color: black;    float: " . $align . ";    padding: 8px;    text-decoration: none;border: 1px solid #ddd;  border-radius: 5px; margin:2px;background-color: #1A446C;    color: white;}
#pagination a:hover:not(.paging_cur) {background-color: #ddd;}

.permission_td{ padding-" . $align . ":40px;}

/*MENU----------------------------------------------------*/
.menu-primary-wrapper { width: 100%;    height: 50px;   background: url(../back_images/menu-primary-wrapper-bg.png) bottom " . $align . " repeat-x;clear: both;}
.menu-primary {  margin: 0 auto;}
.menu-primary ul {  margin: 0;  list-style: none;}
.menu-primary li {  list-style-type: none;  background: url(../back_images/menu-item-border.png) center " . $align . " no-repeat;   position: relative; float: " . $align . ";}
.menu-primary li:hover > a {    background: url(../back_images/menu-item-act.png) center " . $align . " no-repeat;  color: #56c3e2; text-shadow: #252525 0 1px 0;}
.menu-primary li:hover > a span {   background: url(../back_images/ico-bullet-blue-1.png) {$otheralign} 6px no-repeat;  padding: {$thisPadding};}
.menu-primary ul ul {   position: absolute; top: 49px;  " . $align . ": -4px;   width: 224px;   background: url(../back_images/jqueryslidemenu-bg.png) bottom center no-repeat; padding: 0 0 9px 0; float: read_xmls('/site/config/align'); display: none;  z-index: 103;}
.menu-primary ul ul ul {    position: absolute; top: 0px;   " . $align . ": 216px;  width: 224px;   background: url(../back_images/jqueryslidemenu-bg.png) bottom center no-repeat; padding: 0 0 9px 0; float: " . $align . ";  display: none;  z-index: 100;}
.menu-primary ul li:hover > ul {    display: block;}
.menu-primary .menu-item a {    margin: " . $menu_margin . ";   text-align: center; font-size: 15px;    font-weight: normal;    color: #fff;    text-decoration: none;  text-shadow: #000 0 1px 0;  display: block; position: relative; z-index: 1;}
.menu-primary .menu-item a i {  padding: 15px 21px 0 21px;  height: 35px;   font-style: normal; background: url(../back_images/menu-item-border.png) center right no-repeat;    display: block;}
.menu-primary .menu-item a span {   background: url(../back_images/ico-bullet-1.png) {$otheralign} 6px no-repeat;   padding: {$thisPadding};}
.menu-primary ul ul .menu-item a span { background: url(../back_images/ico-bullet-1.png) {$otheralign} 3px no-repeat;   padding: {$thisPadding};}
.menu-primary .menu-item a:hover {  margin: " . $menu_margin . ";   background: url(../back_images/menu-item-act.png) center " . $align . " no-repeat;  text-align: center; font-weight: normal;    color: #56c3e2; text-decoration: none;  text-shadow: #000 0 1px 0;  display: block; position: relative; z-index: 1;}
.menu-primary .menu-item a:hover span { background: url(../back_images/ico-bullet-blue-1.png) {$otheralign} 6px no-repeat;  padding: {$thisPadding};}
.menu-primary ul ul .menu-item a:hover span {   background: url(../back_images/ico-bullet-1.png) {$otheralign} 3px no-repeat;   padding: {$thisPadding};}
.menu-primary ul ul .menu-item a {  width: 164px;   height: auto;   padding: 11px 25px 10px 25px;   margin: 0 5px;  border: none;background: url(../back_images/jqueryslidemenu-sub-level-bg.png) top " . $align . " repeat-x;  color: #fff;    font-size: 14px;    font-weight: normal;    text-align: " . $align . "; text-shadow: #252525 0 1px 0;   text-decoration: none;  display: block;}
.menu-primary ul ul .menu-item a i {    padding: 0; height: auto;   font-style: normal; background: none;   display: inline;}
.menu-primary ul ul .menu-item a:hover {    width: 164px;   height: auto;   padding: 11px 25px 10px 25px;   margin: 0 5px;  border: none;   background: #102f51 url(../back_images/jqueryslidemenu-sub-level-bg.png) top " . $align . " repeat-x;   color: #fff;    font-size: 14px;    font-weight: normal;    text-align: " . $align . "; text-shadow: #252525 0 1px 0;   text-decoration: none;  display: block;}
.menu-primary ul ul li {    background: none;}
.menu-primary ul ul li:hover > a {  background: #102f51 url(../back_images/jqueryslidemenu-sub-level-bg.png) top " . $align . " repeat-x;   color: #fff;    text-shadow: #252525 0 1px 0;}
/*Layout----------------------------------------------------*/
    #dhtmlgoodies_dragDropContainer{background-color:#FFF;  -moz-user-select:none;  }
    #dhtmlgoodies_dragDropContainer li,#dragContent li,li#indicateDestination{list-style-type:none; border:1px solid #000;  padding:5px;    margin: 0 0 5px 0;  cursor:move;    font-size:12px;border:1px solid #AEAEAE;background-image:url(../back_images/plug-bg.png);background-repeat:repeat;border-radius:5px;box-shadow:0 0 4px #ccc;padding:6px}
    li#indicateDestination{ border:1px solid #fff;background-color:#FFF;border:1px solid #AEAEAE;background-image:url(../back_images/layout-bg.png);background-repeat:repeat;border-radius:5px;box-shadow:0 0 4px #ccc;padding:16px 6px}


    div#dhtmlgoodies_listOfItems:lang(ar){padding: 8px 0 0 0;width:20%;display: inline-block; float: right}
    .plugin_cont:lang(en){padding: 8px 0 0 0;width:18%;margin: 2%; display: inline-block;float: left; overflow: hidden !important}

      #plugins li:lang(ar), #dhtmlgoodies_mainContainer li:lang(ar){margin-bottom: 10px ;position: relative;left: 20px !important; background-image: none !important; background: #eee}
      #plugins li:lang(en){ position: relative;left: 0px !important;}
     #dhtmlgoodies_mainContainer li:lang(en){ position: relative;left: -39px !important;}


    div#dhtmlgoodies_mainContainer{ width: 75%; margin:10px; display: inline-block; float: left}

    #dhtmlgoodies_mainContainer div{margin:0 0 10px 0;border:1px solid #AEAEAE;background-image:url(../back_images/layout-bg.png);background-repeat:repeat;border-radius:5px;box-shadow:0 0 4px #ccc;padding:6px    }

    #dhtmlgoodies_mainContainer #topDIV{height:230px;width: 100%;background-image:url(../back_images/layout-bg.png);}

    #dhtmlgoodies_mainContainer #leftDIV{height:170px;width:35%;  display: inline-block; float: left; margin: 2% 2% 2% 0;background-image:url(../back_images/layout-bg.png); }

    #dhtmlgoodies_mainContainer #main-position{    margin-top: 16px;background:url(../back_images/main-position.png) no-repeat center center !important;background-size: contain !important;height:170px;width:22%; display: inline-block;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background: #fff}

    #dhtmlgoodies_mainContainer #rightDIV:lang(ar){height:170px;width:35%;  display: inline-block; float: right; margin: 2% 0% 2% 4%;background-image:url(../back_images/layout-bg.png);}

     #dhtmlgoodies_mainContainer #rightDIV:lang(en){height:170px;width:35%;  display: inline-block; float: right; margin: 2% 4% 2% 0%;background-image:url(../back_images/layout-bg.png);}

    #dhtmlgoodies_mainContainer #bottomDIV{height:230px;width:100%; margin-top:15px;background-image:url(../back_images/layout-bg.png);}

    #dhtmlgoodies_mainContainer ul{
      height:80px;border:0px;margin-bottom:0px;overflow:hidden;   }

    #dragContent:lang(ar){position:absolute; width:200px;height:20px;display:none;margin:-86px;padding:0px;z-index:2000;}
    #dragContent:lang(en){position:absolute; width:200px;height:20px;display:none;margin:-100px -350px;padding:0px;z-index:2000;}


    #dragDropIndicator{ position:absolute;width:7px;height:55px !important;display:none;z-index:1000;margin:0px;padding:50px 0px !important;}
    #footer_layout{ padding-top:30px;   clear: both; margin-bottom:20px;}

/* FORM Style-----------------------------------------------*/
input,textarea,.inputbox-sml,select{font:" . $general_font . ";font-size:13px;background-color:#FFF;border:1px solid #B8B8B8;-moz-border-radius:3px;-khtml-border-radius:3px;-webkit-border-radius:3px;border-radius:3px;padding:5px;outline:none;}

.button,.button-alt,.button-sml,.button-alt-sml{background:url(../back_images/buttons.png) repeat-x top;border:1px solid #0D87AE!important;color:#06465B;border-radius:4px;-moz-border-radius:4px;font-weight:600;-webkit-box-shadow:0 1px 2px #999;-moz-box-shadow:0 1px 2px #999;box-shadow:0 1px 2px #999;text-shadow:1px 1px 1px #70CAE8;padding:3px 10px}
.button-sml,.button-alt-sml{border-radius:3px;-moz-border-radius:3px;font-size:12px;padding:4px 8px;text-shadow:1px 1px 2px #70CAE8;}
.button:hover,.button-sml:hover{background:url(../back_images/buttons.png) 0 -50px;border:1px solid #005977;cursor:pointer;text-decoration:none;color:#000}
select{width:270px;color:#333333; max-height:35px;}
textarea,input[type='text'],input[type='password'],input[type='file']{color:#333333;}
.border {margin: 1px; background-color:#ffffff; padding: 1em; border:1px solid #eeeeee;}
.date{font-size:12px; color:#999999; font-style:italic}
.navigat{float:" . $align . "; width:600px;}
.search {float:" . $otheralign . ";}
#dataTables-example_filter .fa-search:lang(ar){
    background: #eee !important;
    padding: 7.1px !important;
    border-radius: 0px 5px 5px 0px;
    border: 1px solid #ccc;
    color: #999;
    border-left: 0 !important;
    position: relative;
    top: 1.5px;
}
#dataTables-example_filter .fa-search:lang(en){
    background: #eee !important;
    padding: 7.1px !important;
    border-radius: 0px 5px 5px 0px;
    border: 1px solid #ccc;
    color: #999;
    border-left: 0 !important;
}
#side-menu .input-group-btn button i:lang(en) {
    padding: 3px !important
}
#dataTables-example_filter input:lang(ar) {
    border-radius: 5px 0px 0px 5px;
    border-right: 0;
    border: 1px solid #ccc;
    width: 160px;
}
#dataTables-example_filter input:lang(en) {
    border-radius: 5px 0px 0px 5px;
    border-right: 0;
    border: 1px solid #ccc;
    width: 83%;
}

#result {   height:20px;    font-size:16px; color:#333; padding:5px;margin-bottom:10px; background-color:#FFFF99;}
.suggestionsBox {   position: absolute; " . $align . ": 0px;    top:5px;    margin: 26px 0px 0px 0px;width: 200px;  padding:0px;background-color: #000; border-top: 3px solid #000; color: #fff;z-index:100;}
.suggestionList {   margin: 0px;    padding: 0px;}
.suggestionList ul li { list-style:none;    margin: 0px;    padding: 6px;   border-bottom:1px dotted #666;  cursor: pointer;}
.suggestionList ul li:hover {   background-color: #FC3; color:#000;}
.suggestionList ul {font-size:11px; color:#FFF; padding:0;  margin:0;}
.load{background-image:url(../back_images/loader.gif);background-position:" . $otheralign . ";background-repeat:no-repeat;}
#suggest {position:relative;}
.cli{background-color:#ffffcc;}
.cli td{border-radius:5px;-moz-border-radius:5px;}
.plugin_cont{ max-height:560px; overflow-y:auto;}
.short_desc{width:588px !important; height:100px;}
.small{font-size: 10px; color: #ccc;}
.file_uploading {    margin-top: 15px;}
#hidden {    display: none;}
.gallery {  width:100%; float:left;}
.gallery ul{    margin:0;   padding:0;  list-style-type:none;}
.gallery ul li{ padding:7px;    border:2px solid #ccc;  float:left; margin:10px 7px;    background:none;    width:auto; height:auto;}
.images {   height:100px;}

/* new admin pages */
.layout-float:lang(ar){
  float:right;
}
#page-wrapper{
    position: relative !important;
    left: -250px !important;
    background: #fff !important;
}

.nav-second-level li:lang(en) {
    margin-left: 30px
}
.nav-second-level li:lang(ar) {
    position: relative;
    left: 29px !important;
}
.arrow:lang(ar) {
    position: relative;
    left: 5px
}

* {
	outline: none !important
}
.dashboard:lang(en){
  direction:rtl !important;
}
.dashboard-float:lang(ar){
  float:right !important;

}

.dashboard-float:lang(en){
  float:left !important;

}
.dashboard .panel {
    padding-bottom: 0 !important
}
 .visit-stats:lang(en){
   direction:ltr !important;
 }
.button-table .fa-remove:lang(ar){
    position: relative;
    left: -55px !important
 }

.button-table .fa-home:lang(ar){
    position: relative;
    left: -119px !important;
 }
 .button-table .fa-home:lang(en){
    position: relative;
    left: 99px !important;
 }

 .block select{
    width: 100%
 }

 .button-table .fa-edit:lang(ar) {
    position: relative;
    left: -60px !important
 }

 .button-table .fa-language:lang(ar) {
    position: relative;
    left: -53px !important
 }
 .button-table .fa-lock:lang(ar) {
    position: relative;
    left: -85px !important
 }
 .button-table .fa-unlock:lang(ar) {
    position: relative;
    left: -60px !important
 }
 .button-table .fa-long-arrow-down:lang(ar) {
    position: relative;
    left: -97px !important
 }
 .button-table .fa-long-arrow-up:lang(ar) {
    position: relative;
    left: -96px !important
 }

 .fa-search:lang(en) {
 float: right !important
}

.arrow {
	float: left !important
}

.paging_simple_numbers {
	display: inline-block;
	float:left
}
.button {
	background: #337ab7 !important;
    color: #fff  !important;
}

h2 {
	display: inline-block !important;
	margin: 0 !important
}

.navbar-brand{
	position: absolute;
	right: 0;
  margin-top:5px;
}

th{
	text-align: center !important
}

input[type=text] {
	border-radius: 5px
}

.fa-plus{
    position: relative;
    left: -6px !important;
}

.first-table th, .first-table td{
	border-right: 1px solid #ccc !important
}

.margin-link {
    margin-right: 10px
}

.no-border {
	border: none !important
}

.margin-right-fivePx {
	margin-right: 5px  !important
}

.shadow {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
    padding: 20px;
    background: #fff
}

.fa-th-list {
	margin-right:5px
}

.fa-list-ul, .fa-minus   {
	position:relative;
	left: 5px !important
}

/* English Direction */


 #page-wrapper:lang(en){
    left: 0px !important;
    background: #fff !important;
}


.paging_simple_numbers:lang(en) {
	display: inline-block;
	float:right
}

.fa-list-ul:lang(en), .fa-minus:lang(en) {
	position:relative;
	left: -10px !important
}
.button-table{width: 100% !important}
.button-table:lang(en) {
	float: left !important
}
.button-table .fa-remove:lang(en){
    position: relative;
    left: 67px !important
 }

 .button-table .fa-edit:lang(en) {
    position: relative;
    left: 74px !important
 }
 .button-table .fa-lock:lang(en) {
    position: relative;
    left: 88px !important
 }
 .button-table .fa-unlock:lang(en) {
    position: relative;
    left: 75px !important
 }
 .button-table .fa-language:lang(en) {
    position: relative;
    left: 83px !important
 }
 .button-table .fa-long-arrow-down:lang(en) {
    position: relative;
    left: 95px !important
 }
 .button-table .fa-long-arrow-up:lang(en) {
    position: relative;
    left: 79px !important
 }

 .fa-search:lang(en) {
 float: right !important
}
#dataTables-example_length span:lang(en) {
    border-right: 0;
    border-radius: 5px 0px 0px 5px;
}
#dataTables-example_length select:lang(en){
    border-radius: 0px 5px 5px 0px;
    border: 1px solid #ccc;
}
.panel .panel-heading .fa-plus:lang(en), .panel .panel-heading .fa-edit:lang(en)  {
	position: relative;
	left: 7px !important
}
.pull-left:lang(en) {
	float: right !important
}



 .fa-th-list:lang(en) {
 margin-left: 10px !important }

 .first-table th:lang(en), .first-table td:lang(en){
 border-left: 1px solid #ccc !important }
 .margin-link {
 margin-left: 10px
}
 .fa-th-list.panel .panel-heading .fa-plus:lang(en)  {
 margin-left:5px }
 .first-table th:lang(en), .first-table td:lang(en){
 border-right: 1px solid #ccc !important }
 .margin-link:lang(en) {
 margin-right: 10px }
 .margin-right-fivepx:lang(en) {
 margin-right: 5px !important }

.sidebar .nav-second-level li a{
  padding-left: 0px !important
}



@media screen and (max-width: 991px) {
    div#dhtmlgoodies_mainContainer {
        display: block!important;
        width: 80% !important
        position:relative;

    }
    #topDIV{
      height: 230px;
    }
    #rightDIV{
      height:250px !important;
    }
    #leftDIV{
      height:250px !important;

    }
    #dhtmlgoodies_mainContainer #bottomDIV{
          margin-top:60px;
    }

    div#dhtmlgoodies_mainContainer {
        display: block!important;
        width: 95% !important
    }
    div#dhtmlgoodies_listOfItems{
        padding: 8px 0 0 0;width:100%;display: block
    }
    .panel-heading a:nth-child(2) {
        margin-bottom: 10px
    }
    .panel-heading a:nth-child(4), .panel-heading a:nth-child(3){
        display: block !important;
        width: 100% !important;
        margin-bottom: 10px
    }
     .col-xs-3 i{
      position: relative;
      left: 0px
    }
    div#dhtmlgoodies_listOfItems:lang(ar), div#dhtmlgoodies_listOfItems:lang(en) {
        width: 100% !important
    }
}

@media screen and (max-width: 767px) {
    .navbar-top-links .dropdown-menu:lang(en) {
        margin-left: 0px !important
     }
     .dashboard-float{
         width: 100%;
     }
    .sidebar {
      padding-bottom: 0%;
      display: none
    }
.plugin_cont:lang(en){width:95%;  display: inline-block;float: left; overflow: hidden !important}

    .user-menu:lang(en) {
        left: -190px
    }

}

.navbar-header span{color:#f1f1f1}
");
?>
