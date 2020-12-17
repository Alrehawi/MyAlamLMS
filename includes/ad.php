<?php

class Ad extends DatabaseObject {

    public static $table_name = "ads";
    protected static $db_fields = array('id', 'title', 'content', 'lang_id', 'publish', 'sort_id', 'url', 'target', 'photo', 'adsec_id', 'ad_type', 'created', 'updated');
    public $id;
    public $title;
    public $content;
    public $lang_id;
    public $publish;
    public $sort_id;
    public $url;
    public $target;
    public $photo;
    public $adsec_id;
    public $ad_type;
    public $created;
    public $updated;
    public static $trans_key = "ad";
    public $errors = array();

    public static function find_by_adsec($adsec_id = 0, $order = " ORDER BY sort_id ASC") {
        global $database,$session;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE adsec_id=" . $database->escape_value($adsec_id);
        $sql .= " AND publish=1";
        $sql .=$order;
        $ad = self::find_by_sql($sql);
        return $ad;
    }

    // this function deltetes the adsec's ads and its related translates
    public function delete_by_adsec($adsec_id = 0) {
        global $database;
        $ads = self::find_by_adsec($adsec_id);
        foreach ($ads as $ad):
            $delete_ad_translates = Translator::delete_by_parent($ad->id, self::$trans_key);
            $this->id = $ad->id;
            $this->delete();
        endforeach;
        $this->affected_rows = $database->affected_rows();
        return ($database->affected_rows() > 0) ? true : false;
    }

    public function save_ad() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->url) || empty($this->target) || empty($this->photo) || empty($this->adsec_id)) {
              echo $this->target;
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars
            else if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
                /* } else if(!isValidURL($this->url)){
                  $this->errors[] = read_xmls('/site/msg/notvalidurl'); */
            } else {
                return $this->update();
            }
        } else {

            // check required feilds
            if (empty($this->title) || empty($this->url) || empty($this->target) || empty($this->photo) || empty($this->adsec_id)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            } else
            // check limit chars
            if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
                /* } else if(!isValidURL($this->url)){
                  $this->errors[] = read_xmls('/site/msg/notvalidurl'); */
            } else {
                return $this->create();
            }
        }
    }

}

?>
