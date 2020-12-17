<?php

// If it's going to need the database, then it's
// probably smart to require it before we start.

class User extends DatabaseObject {

    public static $table_name = "users";
    protected static $db_fields = array('id', 'username', 'password', 'email', 'role_id',
        'active_key', 'active_valid', 'publish', 'is_locked','login_fail_count', 'lock_start_timestamp', 'lang_id', 'created', 'updated');
    public $id;
    public $username;
    public $password;
    public $email;
    public $role_id;
    public $active_key;
    public $active_valid;
    public $publish;
    public $is_locked;
    public $login_fail_count;
    public $lock_start_timestamp;
    public $lang_id;
    public $created;
    public $updated;
    public $errors = array();
    public static $lockout_minutes=5;
    public static $login_fail_max=4;
    public static $timestamp;

    function __construct() {
        self::$timestamp = date("Y-m-d H:i:s");
    }

    //get user role name
    public function title() {
        if (isset($this->role_id)) {
            $title = Role::find_by_id($this->role_id);
            return $title->title;
        } else {
            return "";
        }
    }

    public static function authenticate($username = "", $password = "") {
        global $database,$session;
        $username = $database->escape_value($username);
        $password = $database->escape_value($password);
        $userLogged = self::userExists($username);
        if(!$userLogged){
          $session->message(read_xmls('/site/adminlogin/msg/incordata'));
          redirect_to("./");
        }


        $sql = "SELECT * FROM " . self::$table_name . " ";
        $sql .= "WHERE username = '{$username}' ";
        $sql .= " AND password = '{$password}' ";
        $sql .= " AND active_valid = '1' ";
        $sql .= " LIMIT 1 ";
        $result_array = self::find_by_sql($sql);
        $res = array_shift($result_array);

        if(empty($res)){
          $remainAttemps=self::remainAttemps($userLogged->id);
          self::logFailLoginAttemp($userLogged->id);
          $session->message(read_xmls('/site/adminlogin/msg/failattemp').": " .$remainAttemps);
          redirect_to("./");
        } else if($res->is_locked==1){
          self::checkTimeToUnlock($userLogged->id);
          $session->message(read_xmls('/site/adminlogin/msg/userlocked'));
          redirect_to("./");
        } else if($res->publish==0){
          $session->message(read_xmls('/site/adminlogin/msg/userunpublished'));
          redirect_to("./");
        } else {
          if(self::checkTimeToUnlock($userLogged->id)){
          return $res;
        }
        }
        //return !empty($result_array) ? array_shift($result_array) : false;
    }

    private static function userExists($username){
      global $database;
      $sql = "SELECT * FROM " . self::$table_name . " ";
      $sql .= "WHERE username = '{$username}' ";
      $result_array = self::find_by_sql($sql);
      return !empty($result_array) ? array_shift($result_array) : false;
    }

    public static function logFailLoginAttemp($id){
      global $database;
      $sql = "UPDATE " . self::$table_name . " SET ";
      $sql .= " login_fail_count=login_fail_count + 1 ";
      $sql .= " WHERE id=" . $database->escape_value($id);
      $database->query($sql);
      return ($database->affected_rows() == 1) ? true : false;
    }

    public static function resetLoginAttemps($id){
      global $database;
      $sql = "UPDATE " . self::$table_name . " SET ";
      $sql .= "is_locked=0,login_fail_count=0, lock_start_timestamp=Null";
      $sql .= " WHERE id=" . $database->escape_value($id);
      $database->query($sql);
    }

    public static function lockUser($id){
      global $database;
      $sql = "UPDATE " . self::$table_name . " SET ";
      $sql .= " is_locked=1,lock_start_timestamp = '".self::$timestamp."' ";
      $sql .= " WHERE id=" . $database->escape_value($id);
      $database->query($sql);
    }

    public static function remainAttemps($id){
      global $database,$session;
      $user = self::find_by_id($id);
      $remainAttemps= self::$login_fail_max - $user->login_fail_count;
      if($user->is_locked ==1){
        self::checkTimeToUnlock($id);
        $session->message(read_xmls('/site/adminlogin/msg/userlocked'));
        redirect_to("./");
      }
      if($remainAttemps <= 0){
        self::lockUser($id);
        $session->message(read_xmls('/site/adminlogin/msg/userlocked'));
        redirect_to("./");
      } else {
        return $remainAttemps;
      }
    }

    public static function checkTimeToUnlock($id){
      global $database,$session;
      $user = self::find_by_id($id);
      $dif = (strtotime(self::$timestamp) - strtotime($user->lock_start_timestamp));

      if ($dif > self::$lockout_minutes * 60) {
        self::resetLoginAttemps($id);
        return true;
      } else {
        $session->message(read_xmls('/site/adminlogin/msg/userlocked'));
        redirect_to("./");
      }
    }

    //forget password
    public static function update_pass($id = 0, $pass = "") {
        global $database;
        $sql = "UPDATE " . self::$table_name . " SET ";
        $sql .= "password='" . $database->escape_value($pass) . "'";
        $sql .= " WHERE id=" . $database->escape_value($id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    //activate account
    public static function activate_account($id = 0) {
        global $database;
        $sql = "UPDATE " . self::$table_name . " SET ";
        $sql .= "active_valid=1";
        $sql .= " WHERE id=" . $database->escape_value($id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public function save_user() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->role_id) || empty($this->password) || empty($this->email)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars
            if (strlen($this->password) >= 50 || strlen($this->email) >= 50) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            }
            // check valid mail
            if (!check_emails($this->email)) {
                $this->errors[] = read_xmls('/site/msg/validemail');
                return false;
            }
            // check avaliable email
            $current_user = self::find_by_id($this->id);
            if ($this->email != $current_user->email && $this->check_entry($this->email, "email") > 0) {
                $this->errors[] = read_xmls('/site/msg/mailexist');
                return false;
            } else {
                return $this->update();
            }
        } else {

            // check required feilds
            if (empty($this->role_id) || empty($this->username) || empty($this->password) || empty($this->email)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars
            if (strlen($this->username) >= 50 || strlen($this->password) >= 50 || strlen($this->email) >= 50) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            }
            // check avaliable username
            if ($this->check_entry($this->username, "username") > 0) {
                $this->errors[] = $this->username . ": " . read_xmls('/site/msg/usernameexist');
                return false;
            }

            // check valid mail
            if (!check_emails($this->email)) {
                $this->errors[] = $this->email . ": " . read_xmls('/site/msg/validemail');
                return false;
            }
            // check avaliable email
            if ($this->check_entry($this->email, "email") > 0) {
                $this->errors[] = $this->email . ": " . read_xmls('/site/msg/mailexist');
                return false;
            } else {
                return $this->create();
            }
        }
    }

}

?>
