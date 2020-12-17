<?php

function strip_zeros_from_date($marked_string = "") {
// first remove the marked zeros
    $no_zeros = str_replace('*0', '', $marked_string);
// then remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zeros);
    return $cleaned_string;
}

// used to redirect to othe pages
function redirect_to($location = NULL) {
//   $full_link=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//   $find = DS;
//   $temp = explode($find, $full_link);
//   $temp= end($temp);
//   $location=str_replace($temp,$location,$full_link);
// echo $location;exit;
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function redirect_to_js($location = NULL) {
    if ($location != NULL) {
        echo "<script language=\"JavaScript\">{ location.href=\"$location\"; self.focus(); }</script>";
    }
}

function go_back($back = -1) {
    echo "<script>javascript: window.history.go(" . $back . ")</script>";
}


// manipulate reporting messages
function output_message($message = "" , $cssclass="alert-warning") {
    $style = '';
    if (!empty($message)) {
        return <<<EOD

                <div class="section-block">
                  <div class='alert {$cssclass} alert-dismissable' align="center">
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    {$message}
                  </div>
                </div>
EOD;

    } else {
        return "";
    }
}

function output_message_front($msg = "", $class = '', $id = '') {
    if (!empty($msg)) {
        return "<div class=\"{$class}\" id=\"{$id}\" ><p>{$msg}</p>"
                . "<a href=\"#\" onclick=\"return alertbox_close('{$id}');\"> <span class=\"icon-cross\"></span></a></div>";
    } else {
        return "";
    }
}

// define undefined classes
// spl_autoload_register(function($class_name) {
//     $class_name = strtolower($class_name);
//     $path = "LIB_PATH.DS.{$class_name}.php";
//     if (file_exists($path)) {
//         require_once($path);
//     } else {
//         die("The file {$class_name}.php could not be found.");
//     }
// }

function __autoload_libraries($class_name){
     $class_name = strtolower($class_name);
    $path = "LIB_PATH.DS.{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found.");
    }
}

spl_autoload_register('__autoload_libraries');

// drow the layout
function include_layout_template($template = "") {
    if (file_exists(FILE_PATH . DSO . 'layouts' . DSO . $template)) {
        include(FILE_PATH . DSO . 'layouts' . DSO . $template);
    } else {
        return alert("Layout: " . $template . " is Not Found!");
    }
}

function include_layout_plugin($template = "") {
    if (file_exists(FILE_PATH . DS . 'layouts' . DS . 'plugins' . DS . $template)) {
        include(FILE_PATH . DS . 'layouts' . DS . 'plugins' . DS . $template);
    } else {
        return alert("Plugin: " . $template . " is Not Found!");
    }
}

function include_aid($page = "") {
    if (file_exists(FILE_PATH . DS . 'aids' . DS . $page)) {
        include(FILE_PATH . DS . 'aids' . DS . $page);
    } else {
        return alert("Aid: " . $page . " is Not Found!");
    }
}

function include_action_file($file = "") {
    if (file_exists(FILE_PATH . DSO . 'actions' . DSO . $file)) {
        include(FILE_PATH . DSO . 'actions' . DSO . $file);
    } else {
        return alert("Action: " . $file . " is Not Found!");
    }
}

// find css
function get_css($css = "", $params = '', $linkTag = true, $admin = false) {
    if ($admin) {
        if ($linkTag == true) {
            echo "<link href='" . FILE_RELATIVE . DS . 'stylesheets' . DS . 'admin_css' . DS . $css . "' {$params} media='all' rel='stylesheet' type='text/css' />";
        } else {
            echo FILE_RELATIVE . DS . 'stylesheets' . DS . 'admin_css' . DS . $css;
        }
    } else {

        if ($linkTag == true) {
            echo "<link href='" . FILE_RELATIVE . DS . 'stylesheets' . DS . $css . "' {$params} media='all' rel='stylesheet' type='text/css' />";
        } else {
            echo FILE_RELATIVE . DS . 'stylesheets' . DS . $css;
        }
    }
}

// find JS
function get_js($js = "", $admin = false) {
    if ($admin) {
        echo "<script type='text/javascript' src='" . FILE_RELATIVE . DS . "javascripts" . DS . "admin_js" . DS . $js . "'></script>";
    } else {
        echo "<script type='text/javascript' src='" . FILE_RELATIVE . DS . "javascripts" . DS . $js . "'></script>";
    }
}

function JquerynoConflict() {
    return "<script type='text/javascript'>var JJJ = jQuery.noConflict();</script>";
}

// find relative link
function get_relative_link($dir = "") {
    return (FILE_RELATIVE . DS . $dir);
}

// Creating log function
/*
function log_action($action, $message = "") {
    $logfile = SITE_ROOTDSO . DSO . 'logs' . DSO . 'log.txt';
    $new = file_exists($logfile) ? false : true;
    if ($handle = fopen($logfile, 'a')) { // append (If the file not exists then create it ,If exists open and append it from the end..)
        $timestamp = current_date();
        $ip = $_SERVER['REMOTE_ADDR'];
        $content = "{$timestamp} | With IP: {$ip} | {$action}: {$message} \n";
        fwrite($handle, $content);
        fclose($handle);
        if ($new) {
            chmod($logfile, 0777);
        }
    } else {
        echo "Can't open the log file {$logfile} for writing ...!!";
    }
}
*/
function log_action($action, $message = "") {
    global $session;
   @$activitylog = new ActivityLog();
   @$activitylog->path = $_SERVER['REQUEST_URI'];
   @$activitylog->action = $action;
   @$activitylog->msg = $message;
   @$activitylog->created = current_date();
   @$activitylog->ip_address = $_SERVER['REMOTE_ADDR'];
   @$activitylog->site_id = $session->site_id;
   $activitylog->save();
}

// Creating log function
function create_index($dir) {
    $logfile = $dir . DSO . 'index.php';
    $new = file_exists($logfile) ? false : true;
    if ($handle = fopen($logfile, 'a')) {
        $timestamp = current_date();
        $ip = $_SERVER['REMOTE_ADDR'];
        $content = "<?php header('location: ../'); ?>";
        fwrite($handle, $content);
        fclose($handle);
        if ($new) {
            chmod($logfile, 0777);
        }
    }
}

// convert date to other format
function datetime_to_text($datetime = "") {
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

// convert date to other format
function datetime_simple($datetime = "") {
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y", $unixdatetime);
}

// get current date
function current_date() {
    return strftime("%Y-%m-%d %H:%M:%S", time());
}

// get specific date
function make_date($time) {
    return strftime("%Y-%m-%d %H:%M:%S", $time);
}

  function make_calender_date($time=null) {
  if(!$time){
    $time=time();
  }
  return strftime("%m/%d/%Y %H:%M:%S", $time);
}

function make_event_date($time) {
    return strftime("%Y-%m-%d %H:%M:%S", $time);
}

function simple_date($date) {
    $time = strtotime($date);
    return strftime("%Y-%m-%d", $time);
}

function make_event_show_last($date) {
    $time = strtotime($date);
    return strftime("%m/%d/%Y %H:%M:%S", $time);
}

function simple_date_slash($date) {
    $time = strtotime($date);
    return strftime("%Y/%m/%d", $time);
}

// manipulate the outpit
function output_string($string) {
    return htmlentities($string, ENT_QUOTES, "UTF-8");
}

// manipulate the body outpit
function output_body($string) {
    return nl2br(strip_tags($string, "<strong><em><p>"));
}

// manipulate the undefined variables (Important for php 5.3)
function check_var($var, $method) {
    $method = strtoupper($method);
    if ($method == "GET") {
        if (isset($_GET[$var])) {
            return $_GET[$var];
        } else {
            return "";
        }
    } else if ($method == "POST") {
        if (isset($_POST[$var])) {
            return $_POST[$var];
        } else {
            return "";
        }
    } else if ($method == "SESSION") {
        if (isset($_SESSION[$var])) {
            return $_SESSION[$var];
        } else {
            return "";
        }
    } else {
        return "";
//if(isset($var)){return $var;} else {return '';}
    }
}

// check for valid emial
function check_emails($email) {
    return preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i", $email);
}

// check for valid URL
function isValidURL($url) {
    return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

// get current page with its query string
function get_current_page() {
    $currentFile = $_SERVER["SCRIPT_NAME"];

    $parts = explode(DS, $currentFile);
    $currentFile = $parts[count($parts) - 1];
    $queryString = $_SERVER['QUERY_STRING'];
    if (empty($queryString)) {
        return $currentFile;
    } else {
        return $currentFile . "?" . $_SERVER['QUERY_STRING'];
    }
}

// Add new parameter to current URL
function search_for_flag($link = '', $var = '', $value = '') {
    if (strpos($link, $var) !== FALSE) {
        $link = stristr($link, "&" . $var, TRUE);
    }

    if (strpos($link, '?') === FALSE) {
        return $link . "?" . $var . "=" . $value;
    } else {
        return $link . "&" . $var . "=" . $value;
    }
}

//search for str
function check_str($str, $find) {
    $pos = strpos($str, $find);
    if ($pos === false) {
        return false;
    } else {
        return true;
    }
}


// download files
function download($filename) {
    $file = $filename;
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}

// Password encreption
function encrept($pass) {
    $encreption = md5($pass . 'SawyCMS');
    return $encreption;
}

// define checked rows
function define_checked($get, $post) {
    global $checked_row;
    if ($get) {
        if (strpos($get, ',') !== FALSE) {
            $checked_row = explode(',', $get);
        } else {
            $checked_row = $get;
        }
    } else if ($post) {
        $checked_row = $post;
    }
}

// send emails
function SendMail($To, $From, $Subject, $MailMsg, $SucMsg, $ErrorMsg, $Cc, $Bcc) {
    global $session;
    $FROM = $From;
    $SUBJECT = $Subject;
    $SUBJECT = $SUBJECT;

    $MESSAGE = $MailMsg;
    $MESSAGE = stripslashes(nl2br($MESSAGE));
    $HEADERS = "From: " . $FROM . "\n";
    if (isset($Cc)) {
        $HEADERS .= 'Cc: ' . $Cc . "\r\n";
    }
    if (isset($Bcc)) {
        $HEADERS .= 'Bcc: ' . $Bcc . "\r\n";
    }
    $HEADERS .= 'MIME-Version: 1.0' . "\r\n";
    $HEADERS .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $SendThis = @mail($To, $SUBJECT, $MESSAGE, $HEADERS);

    if (!$SendThis) {
        $session->message($ErrorMsg);
//redirect_to(FILE_RELATIVE.DS.'error.php');
    }
}

function delete_file($path) {
    if (file_exists($path)) {
        return unlink($path);
    } else {
        return false;
    }
}

function limit_text($text = "", $chars = 0) {
    return substr(strip_tags(stripslashes($text)), 0, $chars);
}

function doubleExplode($del1, $del2, $array) {
    $array1 = explode("$del1", $array);
    foreach ($array1 as $key => $value) {
        $array2 = explode("$del2", $value);
        foreach ($array2 as $key2 => $value2) {
            $array3[] = $value2;
        }
    }
    $afinal = array();
    for ($i = 0; $i <= count($array3); $i += 2) {
        if (@$array3[$i] != "") {
            @$afinal[trim($array3[$i])] = trim($array3[$i + 1]);
        }
    }
    return $afinal;
}

function show_published($value = 0, $folder = "back_images") {
    if (empty($value)) {
        return "<i style='font-size: 18px;color: #333;' class='fa fa-lock publish-icon' title='Unpublished'></i>";
    } else {
        return "<i style='font-size: 15px;color: #333;' class='fa fa-unlock publish-icon' title='Published'></i>";
    }
}

function show_icon($icon = 'none.png', $title = 'No Icon', $folder = "back_images", $show_image = true) {
    if ($show_image == true) {
        return "<img src='" . get_relative_link() . $folder . DS . $icon . "' title='" . $title . "'/>";
    } else {
        return get_relative_link() . $folder . DS . $icon;
    }
}

function make_true($value = 0, $folder = "back_images") {
    if (empty($value)) {
        return "<img src='" . get_relative_link() . $folder . DS . "false.png" . "' title='False'/>";
    } else {
        return "<img src='" . get_relative_link() . $folder . DS . "true.png" . "' title='True'/>";
    }
}

function alert($msg) {
    if (!empty($msg)) {
        return "<script>alert('" . strip_tags($msg) . "')</script>";
    }
}

//get content of folder
function folder_content($folder = "", $ext = ".php") {
    if ($handle = opendir(FILE_PATHDSO . DSO . $folder)) {
//sort($handle);
        $icons = "";
        while (false !== ($entry = readdir($handle))) {
            if (strstr($entry, '.') == $ext && $entry != 'index.php') {
                $icons .= $entry . "," . enhance_name($entry, $ext) . "<br />";
            }
        }
        closedir($handle);
        return (doubleExplode(',', '<br />', $icons));
    }
}

//file name
function enhance_name($name = "", $ext) {
    if (!empty($name)) {
        $new = str_replace($ext, "", $name);
        $new = str_replace("_", " ", $new);
        $new = str_replace("-", " ", $new);
        $new = str_replace(".", " ", $new);
        $new = ucwords($new);
        return $new;
    }
}

function encoding($str = '') {
    $str = base64_encode($str . "SawyCMS");
    return $str;
}

function decoding($str = '') {
    $str = base64_decode($str);
    $str = str_replace("SawyCMS", "", $str);
    return $str;
}

function get_home_page_alias() {
    $page = Page::find_by_field('home', 1,'ASC'," AND site_id={$session->site_id}");
    $page = $page[0];
    return $page->url_alias;
}

function limit_words($string, $word_limit) {
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

function get_current_page_type() {
    $currevt_loc = $_SERVER['QUERY_STRING'];
    $key = strstr($currevt_loc, "=", true);
    if ($key) {
        return $key;
    } else {
        redirect_to(FILE_RELATIVES.DS.'error.php?e=get_current_page_type');
    }
}

function replacespaces($str) {
//return str_replace('&nbsp;','<font class="nbsp">&nbsp;</font>',$str);
    return preg_replace('/&nbsp;/', '<font class="nbsp">&nbsp;</font>', $str);
}

function create_alias($str = 'page') {
    return $str . "_" . rand(10000, 1000000);
}

function pushNotification($nType , $nTitle , $nDesc , $nImagePath , $payload=array()){
//$nType new_event or news
  $notification = new Notification() ;
  $notification ->setSrc($nType) ;
  $notification->setTitle($nTitle) ;
  $notification->setMessage($nDesc) ;
  $notification->setImage($nImagePath);

  $notification->setPayload($payload) ;
  $notificationArr = $notification->getNotification () ;
  $OneSignal = new OneSignal () ;
  $response = $OneSignal->sendToAll ($notificationArr);
  //echo json_encode($response);
}

//--------------------------
$nationality_array = array(
  "1"=>"السعودية",
  "2"=>"مصر",
  "3"=>"سوريا",
  "4"=>"لبنان",
  "5"=>"الأردن",
  "6"=>"تونس",
  "7"=>"المغرب",
  "8"=>"الجزائر",
  "9"=>"البحرين",
  "10"=>"قطر",
  "11"=>"الإمارات",
  "12"=>"اليمن",
  "13"=>"العراق",
  "14"=>"الكويت",
  "15"=>"السودان",
  "16"=>"فلسطين",
  "17"=>"بنجلاديش",
  "18"=>"باكستان",
  "19"=>"أفغانستان",
  "20"=>"الفلبين",
  "21"=>"أندونيسيا",
  "22"=>"الهند",
  "23"=>"أخري"
);

$gender_array=array(
  "1"=>"ذكر",
  "2"=>"أنثي"
);

$stage_no_array=array(
  "1"=>"الروضة",
  "2"=>"الإبتدائي",
  "3"=>"المتوسط",
  "4"=>"الثانوي"
);


$level_no_array=array(
  "1"=>"الأول",
  "2"=>"الثاني",
  "3"=>"الثالث",
  "4"=>"الرابع",
  "5"=>"الخامس",
  "6"=>"السادس"
);

$category_id_array=array(
  "1"=>"العربي",
  "2"=>"الدولي"
);

function decode($param,$array){
  return $array[$param];
}


function findImagesFromTXT ($str){
  preg_match_all('/<img[^>]+>/i',$str, $result);
  $images = implode('',$result[0]);
  preg_match_all('%<img.*?src=["\'](.*?)["\'].*?/>%i', $images, $matches);
  $imageViewer = '<div class="one">';
  foreach ($matches[1] as $img) {
    $imageViewer .= <<<EOD
    <div style="float:right;">
    <a class="portfolio-item-link" data-rel="prettyPhoto[gal]" href="{$img}">
      <div style="background-image:url('{$img}');background-size:cover; width:250px; height:200px; margin:10px" ></div>
    </a>
    </div>
EOD;
  }

  $imageViewer .= '</div>';
  return $imageViewer;
}

function replaceImagesFromTXT($str){
  $str = str_replace("\n", '', $str);
  $str = str_replace("\t", '', $str);
  $str = str_replace("&nbsp;", '', $str);
  return preg_replace('/<img[^>]+>/i', '', $str);
}

//%3c%3e
function sanitize($value , $s='%+$'){
  global $session;
  if (preg_match("/[{}\[\]=*@~`^&:;?()!|{$s}]/", $value) || strpos($value, '%3c') !== false ||
  strpos($value, '%3e') !== false || strpos($value, '%3d') !== false || strpos($value, '%27') !== false
    ){
      redirect_to(FILE_RELATIVE.DS.'error.php?e=sanitize');
      exit;
  } else {
    return true;
  }
}
function sanitizePostVal($value ){
  if (preg_match("/[\<\>|]/", $value) || strpos($value, '%3c') !== false ||
  strpos($value, '%3e') !== false || strpos($value, '%3d') !== false || strpos($value, '%27') !== false
    ){
      redirect_to(FILE_RELATIVE.DS.'error.php?e=sanitize');
      exit;
  } else {
    return true;
  }
}

function setToken() {
      $token= bin2hex(openssl_random_pseudo_bytes(32));
      $_SESSION['token'] = $token;
        return '<input type="hidden" name="_token" value="'.$token.'">';
}


function checkToken($postedVal) {
  //echo $_SESSION['token']."<br>";  echo $postedVal."<br>";exit;
  if ($_SESSION['token'] == $postedVal) {
    return true;
  } else {
     return false;
  }
}


function title($txt){
  return limit_words($txt,7)."...";
}

//==========================================================================================
function translate($q, $sl, $tl){
/*   $arrContextOptions=array(
       "ssl"=>array(
           "verify_peer"=>false,
           "verify_peer_name"=>false,
       ),
   );

  $response = file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=".$sl."&tl=".$tl."&hl=hl&q=".urlencode($q), false, stream_context_create($arrContextOptions));
  $jsonArr=json_decode($response,true);
  return $jsonArr[0][0][0];
*/

  $postdata = http_build_query(
    array(
        'q' => $q
    )
);

  $arrContextOptions = array(
    'http' =>array(
          'method'  => 'POST',
          'header'  => 'Content-Type: application/x-www-form-urlencoded',
          'content' => $postdata
      ),
      "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
      )
  );


  $response = @file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl=".$sl."&tl=".$tl."&hl=hl", false, stream_context_create($arrContextOptions));
  $jsonArr=json_decode($response,true);
  return $jsonArr[0][0][0];
}


//==========================================================================================
function jsonUpdate($json ,$key , $value ,$alias){
	//By: Montaser Elsawy @ alharam
	if($json && $key && $value && $alias){
		$json_arr = json_decode($json, true);
		if(array_key_exists($key,$json_arr)){
			$json_arr[$key] = $value;
		}
    $json   = json_encode($json_arr);
		 Language::update_by_field('phrases',$json," WHERE alias = '".$alias."'");
   }
}

//==========================================================================================

//read langs from xml file: lables and configs
function read_xmls($key = '') {
    $key = str_replace('/','_',$key);
    $lang = new Language();
    $phrases = $lang->get_lang();
    if (!$phrases) {
        echo "Error loading Language can't Continue !";
        exit;
    }
    if (strpos($key, '/') === false) {
      $result = @ucfirst($phrases[$key]);
    } else {
      $result = @ucfirst($phrases[$key]);
    }
    if (!$result) {
      $addJson = jsonAdd($key,$phrases);
      if($addJson){
          return (string) $addJson;
      } else {
        echo (string) "This phrase is not exists ! :{$key}";
      }

    } else {
        return (string) $result;
    }
}
//==========================================================================================
function jsonAdd($key,$json_arr){
  //echo json_encode($json_arr);exit;
	if($json_arr && $key){
    $value= str_replace('_',' ',$key);
    $current_lang= Language::check_alias();
    if($current_lang != 'en'){
        $value = translate($value,'en',$current_lang);
    }

		if(!array_key_exists($key,$json_arr)){
			$json_arr[$key] = $value;
		}
    $json   = json_encode($json_arr);
    if(Language::update_by_field('phrases',$json," WHERE alias = '".$current_lang."'")){
        return $value;
    } else {
      return "Error adding phrase: {$key}";
    }

	} else {
		return "Empty Parameters";
	}
}

?>
