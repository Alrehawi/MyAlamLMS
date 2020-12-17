<?php

class Event extends DatabaseObject {

    public static $table_name = "events";
    protected static $db_fields = array('id', 'title', 'has_link', 'url', 'target', 'start_date', 'end_date', 'location', 'sort_id', 'lang_id', 'publish', 'site_id', 'created', 'updated');
    public $id;
    public $title;
    public $has_link;
    public $url;
    public $target;
    public $start_date;
    public $end_date;
    public $lang_id;
    public $location;
    public $sort_id;
    public $publish;
    public $site_id;
    public $created;
    public $updated;
    public static $trans_key = 'event';
    public $errors = array();

    public function save_event() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->start_date) || empty($this->end_date) || empty($this->location)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars		 
            else if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else if ($this->has_link == 1 && !isValidURL($this->url)) {
                $this->errors[] = read_xmls('/site/msg/notvalidurl');
            } else {
                return $this->update();
            }
        } else {

            // check required feilds
            if (empty($this->title) || empty($this->start_date) || empty($this->end_date) || empty($this->location)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            } else if ($this->has_link == 1 && !isValidURL($this->url)) {
                $this->errors[] = read_xmls('/site/msg/notvalidurl');
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