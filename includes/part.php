<?php

class Part extends DatabaseObject {

    public static $table_name = "parts";
    protected static $db_fields = array('id', 'title', 'content', 'lang_id', 'sort_id', 'publish', 'page_id', 'show_title', 'created', 'updated');
    public $id;
    public $title;
    public $content;
    public $lang_id;
    public $sort_id;
    public $publish;
    public $page_id;
    public $show_title;
    public $created;
    public $updated;
    public static $trans_key = 'part';
    public $errors = array();

    public static function find_by_page($page_id = 0, $order = " ORDER BY sort_id ASC") {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE page_id=" . $database->escape_value($page_id);
        $sql .= " AND publish=1";
        $sql .=$order;
        $ad = self::find_by_sql($sql);
        return $ad;
    }

    public function save_part() {
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