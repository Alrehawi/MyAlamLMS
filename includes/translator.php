<?php

class Translator extends DatabaseObject {

    public static $table_name = "translator";
    protected static $db_fields = array('id', 'lang_id', 'parent_id', 'item_type', 'field_type', 'content', 'created', 'updated');
    public $id;
    public $lang_id;
    public $parent_id;
    public $item_type;
    public $field_type;
    public $content;
    public $created;
    public $updated;
    public $errors = array();

    //translate the entry to other language
    public static function translate($parent_id, $field = "", $content = "", $item_type = "", $target_lang) {
        if (!empty($parent_id) && !empty($field) && !empty($item_type) && !empty($target_lang)) {
            $translate = new Translator();
            $translate->lang_id = $target_lang;
            $translate->parent_id = (int) $parent_id;
            $translate->item_type = $item_type;
            $translate->field_type = $field;
            $translate->content = $content;
            $translate->created = current_date();
            return $translate;
        } else {
            return false;
        }
    }

    // check added lang (prevent duplicated records)
    public static function check_lang($parent = 0, $lang_id, $item_type) {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE parent_id=" . $database->escape_value($parent) . " AND lang_id=" . $database->escape_value($lang_id) . " AND item_type='" . $database->escape_value($item_type) . "'";
        $result = $database->query($sql);
        return $database->num_rows($result);
    }

    // find translates by parent and section type
    public static function find_translate_item($parent = 0, $item_type = "", $field_type = "") {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE parent_id=" . $database->escape_value($parent) . " AND item_type='" . $database->escape_value($item_type) . "' AND field_type='" . $database->escape_value($field_type) . "'";
        return self::find_by_sql($sql);
    }

    // find translates by parent , lang and type
    public static function find_translate_by_parent_lang_type($parent = 0, $item_type = "", $field_type = "", $lang_id = 0) {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE parent_id=" . $database->escape_value($parent) . " AND item_type='" . $database->escape_value($item_type) . "' AND field_type='" . $database->escape_value($field_type) . "' AND lang_id=" . $database->escape_value($lang_id);
        return self::find_by_sql($sql);
    }

    //Delete translates by its parent
    public static function delete_by_parent($parent = 0, $item_type = "") {
        global $database;
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE parent_id=" . $database->escape_value($parent) . " AND item_type='" . $database->escape_value($item_type) . "'";
        return $database->query($sql);
    }

    //Delete translates by its language
    public static function delete_by_lang($lang_id = 0) {
        global $database;
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE lang_id=" . $database->escape_value($lang_id);
        return $database->query($sql);
    }

    //Delete translates by its parent and language
    public static function delete_by_parent_lang_type($parent = 0, $lang_id = 0, $type = '') {
        global $database;
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE parent_id=" . $database->escape_value($parent);
        $sql .= " and lang_id=" . $database->escape_value($lang_id);
        $sql .= " and item_type='" . $database->escape_value($type) . "'";
        return $database->query($sql);
    }

}

?>