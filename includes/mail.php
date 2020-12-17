<?php

class Mail extends DatabaseObject {

    public static $table_name = "mails";
    protected static $db_fields = array('id', 'email', 'mobile', 'mail_groups_id', 'publish', 'created', 'updated');
    public $id;
    public $email;
    public $mobile;
    public $mail_groups_id;
    public $publish;
    public $created;
    public $updated;
    public $errors = array();

    //find mails by group
    public static function find_by_mail_groups_id($mail_groups_id = 0, $order = " ORDER BY id ASC") {
        global $database;
        $sql = "SELECT email FROM " . self::$table_name;
        $sql .= " WHERE mail_groups_id=" . $database->escape_value($mail_groups_id);
        $sql .= " AND publish=1";
        $sql .=$order;
        $emails = self::find_by_sql($sql);
        return $emails;
    }

    //for adding list of mail
    public static function get_array_mail($postedmails) {
        $emails = nl2br($postedmails);
        $emails = str_replace("<br />", ",", $emails);
        $emails = str_replace(";", ",", $emails);
        $emails = explode(",", $emails);
        return $emails;
    }

    //save emails
    public function save_mail() {
        if (isset($this->id)) {
            if (empty($this->email)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars		 
            if (strlen($this->email) >= 50) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            }
            // check valid mail
            if (!check_emails($this->email)) {
                $this->errors[] = $this->email . ": " . read_xmls('/site/msg/validemail');
                return false;
            }
            // check avaliable email
            $current_user = self::find_by_id($this->id);
            if ($this->email != $current_user->email && $this->check_entry($this->email, "email") > 0) {
                $this->errors[] = read_xmls('/site/msg/mailexist');
                return false;
            }
            return $this->update();
        } else {
            if (empty($this->email)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars
            if (strlen($this->email) >= 50) {
                $this->errors[] = read_xmls('/site/msg/longer');
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
            }
            return $this->create();
        }
    }

}

?>