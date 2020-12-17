<?php

class Subject extends DatabaseObject {

    public static $table_name = "subjects";
    protected static $db_fields = array('id', 'title', 'url_alias', 'lang_id', 'sort_id', 'main_id', 'photo', 'subject_date', 'show_date',
        'content_short', 'content', 'keywords', 'description', 'fbcomment', 'publish', 'counter', 'created', 'updated');
    public $id;
    public $title;
    public $url_alias;
    public $lang_id;
    public $sort_id;
    public $main_id;
    public $photo;
    public $subject_date;
    public $show_date;
    public $content_short;
    public $content;
    public $keywords;
    public $description;
    public $fbcomment;
    public $publish;
    public $counter;
    public $created;
    public $updated;
    public static $trans_key = 'subject';
    public $errors = array();

    public static function find_by_main($main_id = 0, $order = " ORDER BY sort_id ASC") {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE main_id=" . $database->escape_value($main_id);
        $sql .= " AND publish=1";
        $sql .=$order;
        $ad = self::find_by_sql($sql);
        return $ad;
    }

    public function save_subject() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->url_alias)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            $current_alias = self::find_by_id($this->id);
            if ($this->url_alias != $current_alias->url_alias && $this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
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
            if (empty($this->title) || empty($this->url_alias)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            if ($this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
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