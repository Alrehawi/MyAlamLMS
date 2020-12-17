<?php

// A class to help work with Sessions
// In our case, primarily to manage logging users in and out
// Keep in mind when working with sessions that it is generally
// inadvisable to store DB-related objects in sessions

class Session {

    private $logged_in = false;
    public $user_id;
    public $message;
    public $sent_url;
    public $alias;
    public $captcha;
    public $visitor;
    public $site_id;
    public $errors = array();

    function __construct() {
        session_start();
        $this->check_login();
        $this->check_message();
        $this->check_sent_url();
        $this->check_alias();
        $this->check_captcha();
        $this->check_visitor();
        $this->check_site_id();

        if ($this->logged_in) {
            // actions to take right away if user is logged in
        } else {
            // actions to take right away if user is not logged in
        }
    }

    private function checkAuthorizedUser(){
      if(empty($this->user_id)){
        return false;
      }

       $user = User::find_by_id($this->user_id);
       $role = Role::find_by_id($user->role_id);
       if($role->id == 7){
         return true;
       }

       if($role->site_id == $this->site_id ){
           return true;
       } else {
         return false;
       }
    }

    public function is_logged_in() {
        if($this->checkAuthorizedUser()){
          return $this->logged_in;
        }
    }

    public function login($user) {
        // database should find user based on username/password
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_in = true;
            //change session id after login
            session_regenerate_id();
        }
    }

    //logout
    public function logout() {
        unset($this->user_id);
        session_destroy();
        $this->logged_in = false;
    }

    //check assigned permission
    public function check_permission($permission, $page) {
        if (isset($_SESSION[$permission])) {
            return true;
        } else {
            $this->message(read_xmls('/site/msg/noperm'));
            redirect_to($page);
        }
    }

    //check for this session exists or no
    public function has_permission($permission) {
        if (isset($_SESSION[$permission])) {
            return true;
        } else {
            return false;
        }
    }

    // get permissions array from logined user role and put each permission in a session
    public function register_perms($permissions) {
        //convert string separeted by (,) to an array
        //register each permission on a session
        $perms = explode(',', $permissions);
        foreach ($perms as $perm) {
            $_SESSION[$perm] = true;
        }
    }

    //to check if the user login or not
    private function check_login() {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }

    // Put the message in a session to alarm it once
    public function message($msg = "") {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    //check for the message is registered in a session or not
    private function check_message() {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    public function sent_url($url = "") {
        if (!empty($url)) {
            $_SESSION['sent_url'] = $url;
        } else {
            return $this->sent_url;
        }
    }

    private function check_sent_url() {
        if (isset($_SESSION['sent_url'])) {
            $this->sent_url = $_SESSION['sent_url'];
        } else {
            $this->sent_url = "";
        }
    }

    public function unset_sent_url() {
        unset($this->sent_url);
        unset($_SESSION['sent_url']);
    }

    public function alias($alias = 0) {
        if ($alias) {
            $_SESSION['alias'] = $alias;
        } else {
            return $this->alias;
        }
    }

    private function check_alias() {
        if (isset($_SESSION['alias'])) {
            $this->alias = $_SESSION['alias'];
        } else {
            $this->alias = "";
        }
    }

    public function unset_alias() {
        unset($this->alias);
        unset($_SESSION['alias']);
    }

    public function is_alias_register() {
        return $this->alias;
    }

    public function captcha($captcha = "") {
        if (!empty($captcha)) {
            $_SESSION['captcha'] = $captcha;
        } else {
            return $this->captcha;
        }
    }

    private function check_captcha() {
        if (isset($_SESSION['captcha'])) {
            $this->captcha = $_SESSION['captcha'];
        } else {
            $this->captcha = "";
        }
    }

    public function unset_captcha() {
        unset($this->captcha);
        unset($_SESSION['captcha']);
    }

    public function visitor($visitor = 0) {
        if (!empty($visitor)) {
            $_SESSION['visitor'] = $visitor;
        } else {
            return $this->visitor;
        }
    }

    private function check_visitor() {
        if (isset($_SESSION['visitor'])) {
            $this->visitor = $_SESSION['visitor'];
        } else {
            $this->visitor = "";
        }
    }

    public function unset_visitor() {
        unset($this->visitor);
        unset($_SESSION['visitor']);
    }

    public function site_id($site_id = 0) {
        if (!empty($site_id)) {
            $_SESSION['site_id'] = $site_id;
        } else {
            return $this->site_id;
        }
    }

    private function check_site_id() {
        if (isset($_SESSION['site_id'])) {
            $this->site_id = $_SESSION['site_id'];
        } else {
            $this->site_id = "";
        }
    }

    public function unset_site_id() {
        unset($this->site_id);
        unset($_SESSION['site_id']);
    }

}

$session = new Session();
$message = $session->message();
?>
