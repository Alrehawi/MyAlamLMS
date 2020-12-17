<?php

// If it's going to need the database, then it's
// probably smart to require it before we start.
class DatabaseObject extends Action {

    public static $table_name;

//dates
    public static function sql_date($calender_date) {
        if (!empty($calender_date)) {
            return make_date(strtotime($calender_date));
        }
    }

    public static function calender_date($sql_date) {
        if (!empty($sql_date)) {
            return make_calender_date(strtotime($sql_date));
        }
    }

    public static function event_date($sql_date) {
        if (!empty($sql_date)) {
            return make_event_date(strtotime($sql_date));
        }
    }

    public static function find_object_id($type, $alias) {
        $obj = ucfirst($type);
        @$item = $obj::find_by_field('url_alias', $alias, "ASC", " AND publish=1 ");
        $value = $item[0]->id;
        return $value;
    }

// Common Database Methods
    // start tree generator
    public static function get_patents($id = 0 , $sql_cond = "") {
        global $database;
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE id=" . $database->escape_value($id) ." {$sql_cond} ";
        $menu = static::find_by_sql($sql);

        $path = array();

        if ($menu[0]->parent_id != '') {
            $path[] = $menu[0]->parent_id;
            $path = array_merge(static::get_patents($menu[0]->parent_id), $path);
        }
        return $path;
    }

    public static function get_childrens($parent, $level, $prev_level = NULL) {
        global $database;
        if ($parent == "Null") {
            $sql = "SELECT * FROM " . static::$table_name;
            $sql .= " WHERE parent_id IS NULL AND publish=1 ORDER BY sort_id ASC";
        } else {
            $sql = "SELECT * FROM " . static::$table_name;
            $sql .= " WHERE parent_id=" . $database->escape_value($parent) . "  AND publish=1 ORDER BY sort_id ASC";
        }
        $tree = static::find_by_sql($sql);
        return $tree;
    }

    public static function delete_translate_tree_by_parent($parent, $level, $prev_level = NULL, $key) {
        $trees = static::get_childrens($parent, $level);
        foreach ($trees as $tree):
            if (static::has_child($tree->id)) {
                $prev_level = $level + 1;
            }
            Translator::delete_by_parent($tree->id, $key);
            static::delete_translate_tree_by_parent($tree->id, $level + 1, $prev_level, $key);
        endforeach;
        Translator::delete_by_parent($parent, $key);
    }

    // generate the tree with 2 options
    // @ options of select item (type=options)
    // @ row of manage page (type=rows)
    public static function generate_tree_options($array, $parent = NULL, $indent = "", $type = 'options', $update = 0) {
        global $checked_row;
        $has_children = false;
        $indent = $indent . "&nbsp;&nbsp;&nbsp;";
        foreach ($array as $key => $value) {
            $update == $value['id'] ? $selected = " selected" : $selected = '';
            $disabled = '';
            if (isset($_GET['id'])) {
                $value['id'] == intval($_GET['id']) ? $disabled = " disabled" : $disabled = '';
            }

            if ($value['parent_id'] == $parent) {
                if ($has_children === false) {
                    $has_children = true;
                }
                if ($type == 'options') {

                    echo "<option value='" . $value['id'] . "' id='" . $value['parent_id'] . "' " . $selected . " " . $disabled . ">" . $indent . ":&nbsp;" . $value['title'] . "</option>";
                } else if ($type == 'rows') {
                    if (static::has_child($value['id']) || $value['parent_id'] == '') {
                        $picname = "<i class='fa fa-caret-down'></i>&nbsp; ";
                    } else {
                        $picname = "<i class='fa fa-minus'></i>";
                    }
                    $indent1 = $indent . $picname;
                    echo "<tr><td>{$indent1}";
                    echo $value['title'];
                    //echo "<br>{$value['sort_id']}";

                    echo "</td>";
                    if (@$value['link']) {
                        echo "<td align='center'>" . $value['link'] . "</td>";
                    }
                    if (@$value['addsubject']) {
                        echo "<td align='center'>" . $value['addsubject'] . "</td>";
                    }
                    echo"<td align='center'>" . $value['publish'] . "</td><td align='center'><input type='checkbox' value='" . $value['id'] . "' name='check[]' ";
                    if ((@is_array($checked_row) && in_array($value['id'], $checked_row)) || check_var("checked_row", "GET") == $value['id']) {
                        echo "checked='checked'";
                    }
                    echo " /></td></tr>";
                }
                echo static::generate_tree_options($array, $key, $indent, $type, $update = $update);
            }
        }
    }

    //find childs
    public static function find_childs($id = 0) {
        global $database;
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE parent_id=" . $database->escape_value($id);
        $menu = static::find_by_sql($sql);
        return $menu;
    }

    //check if has child
    public static function has_child($id = 0) {
        global $database;
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE parent_id=" . $database->escape_value($id);
        $results = $database->query($sql);
        return $database->num_rows($results);
    }

    public static function has_parent($id = 0) {
        global $database;
        $sql = "SELECT parent_id FROM " . static::$table_name;
        $sql .= " WHERE id=" . $database->escape_value($id);
        $results = static::find_by_sql($sql);
        return $results[0]->parent_id;
    }

    // end tree generator
    //SEARCH FROM DB
    public static function search($keyword, $fields = array()) {
        global $database;
        if (!is_array($fields)) {
            return false;
        } else {
            $search = trim($database->escape_value($keyword));
            $parts = preg_split("/[\s,]+/", $search);
            foreach ($parts as $part) {
                foreach ($fields as $field) {
                    $clauses[] = "{$field} LIKE '%" . $database->escape_value($part) . "%'";
                }
            }
            $clause = implode(' OR ', $clauses);
            return $clause;
        }
    }

    // check for this field is exists or not
    public function check_entry($entry, $column,$sql_cond = "") {
        global $database;
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE {$column}='" . $database->escape_value($entry) . "'";
        $sql .= " {$sql_cond} ";
        $results = $database->query($sql);
        return $database->num_rows($results);
    }

    public static function find_all($sort = "id ASC", $sql_cond = "") {
      $sql="SELECT * FROM " . static::$table_name . " {$sql_cond} ORDER BY " . $sort;
      //echo $sql;
        return static::find_by_sql($sql);
    }

    // find specific id
    public static function find_by_id($id = 0, $sql_cond = "") {
        global $database;
        $result_array = static::find_by_sql("SELECT * FROM " . static::$table_name . " WHERE id=" . $database->escape_value($id) . " {$sql_cond} LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
        echo $result_array;
    }

    // Find By Field
    public static function find_by_field($field_name = "", $field_id = 0, $sort = 'ASC', $cond = '') {
        global $database;
        $sql = "SELECT * FROM " . static::$table_name;
        $sql .= " WHERE $field_name='" . $database->escape_value($field_id) . "' " . $cond;
        $sql .= " ORDER BY id " . $sort;
        $find = static::find_by_sql($sql);
        return $find;
    }

    public static function find_alias($page = "", $field = "", $folder = "modules") {
        global $session;
        if (file_exists(FILE_PATH . DSO . "layouts" . DSO . $folder . DSO . $page)) {
            if (static::count_by_field('related_class', $page," AND site_id={$session->site_id}")) {
                $module = static::find_by_field('related_class', $page,'ASC'," AND site_id={$session->site_id}");
                if ($field) {
                    $alias = $module[0]->$field;
                    return $alias;
                } else {
                    $alias = $module[0]->url_alias;
                    return $alias;
                }
            }
        } else {
            $session->message(read_xmls('/site/msg/codenotfound') . " :" . $page);
            redirect_to(FILE_RELATIVES.DS.'error.php?e=find_alias');
        }
    }

//language view control
    // this function has 3 parameters (field_type , db id of item , item type on db translator table)
    public static function find_viewed_language($att, $id, $type) {
        $current_lang = Language::current_lang_attribute('id'); // get current language id
        $default_lang = Language::get_default_lang(); // get default site language
        $property = static::find_by_id($id); // find default item language
        $translate_property = Translator::find_translate_by_parent_lang_type($id, $type, $att, $current_lang);
        if (isset($translate_property[0]->content)) { // if translated print the translation
            return stripslashes($translate_property[0]->content);
        } else {
            return stripslashes($property->$att); // else print the default translation
        }
    }

// get only property of object
    public static function find_field_by_id($field = '', $id = 0) {
        global $database;
        $result_array = static::find_by_sql("SELECT {$field} FROM " . static::$table_name . " WHERE id=" . $database->escape_value($id) . " LIMIT 1");
        return $result_array[0]->$field;
    }

// START SORTING
    // find pervious sort id to move
    public static function find_prev_sort_id($sort_id = 0, $sql_cond = "") {
        global $database;
        $sort_id = $database->escape_value($sort_id);
        $result_array = static::find_by_sql("SELECT sort_id FROM " . static::$table_name . " WHERE sort_id < {$sort_id} {$sql_cond} ORDER BY sort_id DESC LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
        echo $result_array;
    }

    // find next sort id to move
    public static function find_next_sort_id($sort_id = 0, $sql_cond = "") {
        global $database;
        $sort_id = $database->escape_value($sort_id);
        $result_array = static::find_by_sql("SELECT sort_id FROM " . static::$table_name . " WHERE sort_id > {$sort_id} {$sql_cond} ORDER BY sort_id ASC LIMIT 1");
        return !empty($result_array) ? array_shift($result_array) : false;
        echo $result_array;
    }

    // increase sort id +1
    public static function count_new_sort_id($sql_cond = "") {
        $max_sort_id = static::find_by_sql("SELECT MAX(sort_id) AS sort_id FROM " . static::$table_name . " {$sql_cond} ");
        $new_sort_id = $max_sort_id[0]->sort_id + 1;
        return $new_sort_id;
    }

    //Resorting records
    public static function resort($parent_id = 0, $parent_name = "") {
        global $database;
        $records = static::find_all('id ASC', "WHERE `" . $parent_name . "`=" . $database->escape_value($parent_id));
        $counter = 0;
        foreach ($records as $record):
            $counter++;
            $sql = "UPDATE " . static::$table_name . " SET ";
            $sql .= "sort_id=" . $database->escape_value($counter);
            $sql .= " WHERE id=" . $database->escape_value($record->id);
            $database->query($sql);
        endforeach;
        return true;
    }

    public static function update_by_field($field, $value, $cond = "") {
        global $database;
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= "{$field}='" . $database->escape_value($value) . "'";
        $sql .= " {$cond} ";
        if ($database->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public static function check_file_exist($id) {
        if (file_exists(self::get_file_sys_path($id))) {
            return true;
        } else {
            return false;
        }
    }

    public static function get_file_sys_path($id) {
        $file = static::find_by_id($id);
        if (!empty($file->id)) {
            return FILE_PATH . DSO . $file->upload_dir . DSO . $file->filename;
        }
    }

    public static function sum_field($field, $cond) {
        global $database;
        $sql = "SELECT SUM(" . $field . ") FROM " . static::$table_name . " " . $cond;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return $row['SUM(' . $field . ')'];
    }

// END SORTING
    //update counter +1
    public static function increase_counter($id = 0, $where = '') {
        global $database;
        $counter = static::find_by_id($id);
        $new_counter = $counter->counter + 1;
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= "counter=" . $database->escape_value($new_counter);
        $sql .= " WHERE id=" . $database->escape_value($id);
        if (!empty($where)) {
            $sql .= " AND {$where} ";
        }
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public static function all_visits($where=''){
        global $database;
        $visits_all = static::find_by_sql("select sum(counter) AS counter from ".static::$table_name." {$where} ");
        $visits = $visits_all[0]->counter;
        return $visits;
    }
    // get max id + 1
    public static function find_max_id() {
        $max_id = static::find_by_sql("SELECT MAX(id) AS id FROM " . static::$table_name);
        $id = $max_id[0]->id + 1;
        return $id;
    }

    public static function find_last_id() {
        $max_id = static::find_by_sql("SELECT MAX(id) AS id FROM " . static::$table_name);
        $id = $max_id[0]->id;
        return $id;
    }

    //find query by sql statment
    public static function find_by_sql($sql = "",$instantiate=true) {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_array($result_set)) {
          if($instantiate){
            $object_array[] = static::instantiate($row);
          } else {
              $object_array[] = $row;
          }
        }
        return $object_array;
    }

    public static function find_by_sql_assoc($sql = "",$instantiate=true) {
        global $database;
        $result_set = $database->query($sql);
        $object_array = array();
        while ($row = $database->fetch_assoc($result_set)) {
          if($instantiate){
            $object_array[] = static::instantiate($row);
          } else {
              $object_array[] = $row;
          }
        }
        return $object_array;
    }


    // Count for paganition
    public static function count_all($cond = "") {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $sql .= " {$cond}";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    // count by sql statement
    public static function count_by_sql($cond = "") {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name;
        $sql .=" {$cond} ";
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    // count by sql statement
    public static function count_by_sql_stat($sql = "") {
        global $database;
        $result_set = $database->query($sql);
        return $database->num_rows($result_set);
    }

    // Count for paganition by field
    public static function count_by_field($field_name = "", $field_id = 0, $cond = '') {
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$table_name . " WHERE " . $database->escape_value($field_name) . "='" . $database->escape_value($field_id) . "' " . $cond;
        $result_set = $database->query($sql);
        $row = $database->fetch_array($result_set);
        return array_shift($row);
    }

    private static function instantiate($record) {
        // Could check that $record exists and is an array
        $class_name = get_called_class();
        $object = new $class_name;
        // More dynamic, short-form approach:
        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }


        public static function getField($id,$target,$translate=true){
          $obj = static::find_by_id($id);
          if($obj){
            if($target == "title" && $translate){
              return static::find_viewed_language($target, $obj->id, static::$trans_key);
            } else {
              return $obj->$target;
            }
          } else {
            return false;
          }
        }

    private function has_attribute($attribute) {
        // get_object_vars returns an associative array with all attributes
        // (incl. private ones!) as the keys and their current values as the value
        $object_vars = $this->attributes();
        // We don't care about the value, we just want to know if the key exists
        // Will return true or false
        return array_key_exists($attribute, $object_vars);
    }

    protected function attributes() {
        $attributes = array();
        foreach (static::$db_fields as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attriutes() {
        global $database;
        $clean_attributes = array();
        foreach ($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $database->escape_value($value);
        }
        return $clean_attributes;
    }

    //create or update object
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    //create object standard sql
    /* 	public function create(){
      global $database;
      ob_start();
      $attributes = $this->sanitized_attriutes();
      $alter_tbl="ALTER TABLE ".static::$table_name." AUTO_INCREMENT = 1";
      $database->query($alter_tbl);
      $sql = "INSERT INTO ".static::$table_name." (";
      $sql .= join(", " , array_keys($attributes));
      $sql .= ") VALUES ('";
      $sql .= join("', '" , array_values($attributes));
      $sql .= "')";
      if($database->query($sql)){
      $this->id = $database->insert_id();
      return true;
      } else {
      return false;
      }
      } */
    //create object mysql extension
    public function create() {
        global $database;
        $attributes = $this->sanitized_attriutes();
        $attibutes_pairs = array();
        foreach ($attributes as $key => $value) {

          if (is_numeric($value) && $value == 0) {
              $attibutes_pairs[] = "`{$key}`=0";
          } else if ($value == 'Null' || $value == null) {
              $attibutes_pairs[] = "`{$key}`=NULL";
          } else {
              $attibutes_pairs[] = "`{$key}`='{$value}'";
          }
        }
        $alter_tbl = "ALTER TABLE " . static::$table_name . " AUTO_INCREMENT = 1";
        $database->query($alter_tbl);
        $sql = "INSERT INTO " . static::$table_name . " SET ";
        $sql .= join(", ", $attibutes_pairs);
        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    //update object
    public function update() {
        global $database;
        $attributes = $this->sanitized_attriutes();
        $attibutes_pairs = array();
        foreach ($attributes as $key => $value) {

          if (is_numeric($value)  && $value == 0) {
              $attibutes_pairs[] = "`{$key}`=0";
          } else if ($value == 'Null' || $value == null) {
              $attibutes_pairs[] = "`{$key}`=NULL";
          } else {
              $attibutes_pairs[] = "`{$key}`='{$value}'";
          }
        }
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql .= join(", ", $attibutes_pairs);
        $sql .= " WHERE id=" . $database->escape_value($this->id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    //delete all object records
    public function delete_all($where='') {
        global $database;
        $sql = "DELETE FROM " . static::$table_name ." {$where} ";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }


    //delete object
    public function delete() {
        global $database;
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE id=" . $database->escape_value($this->id);
        $sql .= " LIMIT 1";
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

    public static function delete_by_field($field = '', $field_id = 0) {
        global $database;
        $sql = "DELETE FROM " . static::$table_name;
        $sql .= " WHERE {$field}=" . $database->escape_value($field_id);
        $database->query($sql);
        return ($database->affected_rows() == 1) ? true : false;
    }

}

?>
