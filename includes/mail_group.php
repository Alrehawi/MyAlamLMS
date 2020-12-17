<?php

class MailGroup extends DatabaseObject {

    public static $table_name = "mail_groups";
    protected static $db_fields = array('id', 'title', 'lang_id', 'newsletter', 'site_id', 'publish', 'created', 'updated');
    public $id;
    public $title;
    public $lang_id;
    public $newsletter;
    public $publish;
    public $site_id;
    public $created;
    public $updated;
    public static $trans_key = 'mailgroup';
    public $errors = array();

    public function save_mailgroup() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars		 
            else if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else {
                return $this->update();
            }
        } else {

            // check required feilds
            if (empty($this->title)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            } else
            // check limit chars
            if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else {
                return $this->create();
            }
        }
    }

}

?>