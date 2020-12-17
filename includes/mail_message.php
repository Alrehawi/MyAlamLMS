<?php

class MailMessage extends DatabaseObject {

    public static $table_name = "mail_messages";
    protected static $db_fields = array('id', 'from', 'subject', 'direction', 'mail_groups_id', 'content', 'created');
    public $id;
    public $from;
    public $subject;
    public $direction;
    public $mail_groups_id;
    public $content;
    public $created;
    public $errors = array();

    public static function send_emails($To, $From, $Subject, $MailMsg, $SucMsg, $ErrorMsg, $Cc, $mail_groups_id, $limit = 0) {
        $emails = Mail::find_by_mail_groups_id($mail_groups_id);
        $all_emails = count($emails);
        foreach ($emails as $email):
            $divided = $email->email;
            //echo $divided;
            //echo "---<br />";
            echo SendMail($divided, $From, $Subject, $MailMsg, $SucMsg, $ErrorMsg, $Cc, $To);
            unset($divided);
        endforeach;
    }

    //save emails
    public function save_mail_message() {
        if (empty($this->from) || empty($this->subject) || empty($this->mail_groups_id) || empty($this->content)) {
            $this->errors[] = read_xmls('/site/msg/allrequire');
            return false;
        }
        // check limit chars
        if (strlen($this->from) >= 50) {
            $this->errors[] = read_xmls('/site/msg/longer');
            return false;
        }

        // check valid mail
        if (!check_emails($this->from)) {
            $this->errors[] = read_xmls('/site/msg/validemail');
            return false;
        }

        return $this->create();
    }

}

?>