<?php

class AdSection extends DatabaseObject {

    public static $table_name = "ads_sections";
    protected static $db_fields = array('id', 'title', 'lang_id', 'publish', 'site_id', 'created', 'updated');
    public $id;
    public $title;
    public $lang_id;
    public $publish;
    public $site_id;
    public $created;
    public $updated;
    public static $trans_key = 'adsec';
    public $errors = array();

    public function save_adsection() {
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