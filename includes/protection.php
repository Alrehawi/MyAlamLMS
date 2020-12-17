<?php

//Protect QueryString Vars
if (isset($_GET['id'])) {
    $_GET['id'] = intval($_GET['id']);
}
if (isset($_GET['parent'])) {
    $_GET['parent'] = intval($_GET['parent']);
}

$queryString= $_SERVER["QUERY_STRING"];

$queryString = doubleExplode('=','&',$queryString);
foreach ($queryString as $key => $sanvalue) {

  $key=sanitize($key);
//  echo "{$sanvalue}<br>";
  if($key=="search"){
    sanitize($sanvalue,'');
  } else {
    sanitize($sanvalue);
  }
}


if(!empty($_POST)){
  foreach ($_POST as $key => $sanvalue) {
    sanitize($key);
  }
}
//exit;
//if(isset($_GET['alias'])){ $_GET['alias']=trim($_GET['alias']); }
?>
