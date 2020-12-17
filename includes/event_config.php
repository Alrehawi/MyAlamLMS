<?php

class EventConfig extends DatabaseObject {

    public static $table_name = "event_config";
    protected static $db_fields = array('id', 'event_date', 'today', 'site_id', 'updated');
    public $id;
    public $event_date;
    public $today;
    public $site_id;
    public $updated;
    public $errors = array();

    //find site config items
    public static function event_config($item) {
      global $session;
        $get_record = self::find_all("id ASC"," WHERE site_id={$session->site_id}");
        $get_record = $get_record[0];
        return $get_record->$item;
    }

    public function save_event_config() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->event_date)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            } else {
                return $this->update();
            }
        } else {

            // check required feilds
            if (empty($this->event_date)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            } else {
                return $this->create();
            }
        }
    }

}

?>
