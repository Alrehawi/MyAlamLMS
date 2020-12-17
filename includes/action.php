<?php

class Action {

    public $action; // Type Of Action
    public $array;  // Checked Rows
    public $page; // Page to redirect
    public $allowMultiSelect; // If allow multi rows to do the action

// Do Action Delete , Edit OR RUN any other action methods

    public function do_action($action = '', $array = array(), $page = '', $allowMultiSelect = FALSE, $sql_cond = "", $field = "") {
        global $session;
        $this->action = $action;
        $this->arrays = $array;
        $this->page = $page;
        $this->allowMultiSelect = $allowMultiSelect;

        $count_array = count($this->arrays);
        
        if(!checkToken($_POST['_token'])){
            $session->message(read_xmls('/site/msg/invalidsubmit'));
            redirect_to("_manage.php");
        }


        if ($this->allowMultiSelect == TRUE) {
            // do the action
            switch ($this->action) {
                case 'dell':
                    // do delele
                    $checked_row = $this->arrays;
                    include ($page);
                    break;

                case 'publish':
                    //do publish
                    for ($Ii = 0; $Ii < $count_array; $Ii++) {
                        echo static::publish($this->arrays[$Ii]);
                    }
                    $checked_row = implode(',', $this->arrays);
                    $session->message(read_xmls('/site/msg/donepublish'));
                    return redirect_to(search_for_flag(get_current_page(), 'checked_row', $checked_row));
                    break;
                case 'unpublish':
                    //do unpublish
                    for ($I = 0; $I < $count_array; $I++) {
                        echo static::unpublish($this->arrays[$I]);
                    }
                    $checked_row = implode(',', $this->arrays);
                    $session->message(read_xmls('/site/msg/doneunpublish'));
                    return redirect_to(search_for_flag(get_current_page(), 'checked_row', $checked_row));
                    break;
                default:
                    $session->message(read_xmls('/site/msg/cantdo'));
                    return redirect_to(search_for_flag(get_current_page(), 'checked_row', $checked_row));
            }
        } else if ($this->allowMultiSelect == FALSE) {
            if (is_array($this->arrays)) {
                $count_array = count($this->arrays);
                if ($count_array != 1) {
                    $checked_row = implode(',', $array);
                    $session->message(read_xmls('/site/msg/checkonlyone'));
                    return redirect_to(search_for_flag(get_current_page(), 'checked_row', $checked_row));
                } else {
                    $checked_row = $_POST['check'][0];

                    switch ($this->action) {
                        case 'defaults':
                            // do Default
                            return static::defaults($checked_row, $this->page, $field, $sql_cond);
                            break;

                        case 'edit':
                            //go to edit page
                            return redirect_to("{$this->page}?id=" . $checked_row);
                            break;
                        case 'translate':
                            //go to translate page
                            return redirect_to("{$this->page}?parent=" . $checked_row);
                            break;
                        case 'sort_up':
                            // do move up
                            return static::move_up($checked_row, $this->page, $sql_cond);
                            break;
                        case 'sort_down':
                            // do move down
                            return static::move_down($checked_row, $this->page, $sql_cond);
                            break;

                        default:
                            $session->message(read_xmls('/site/msg/cantdo'));
                            return redirect_to(search_for_flag(get_current_page(), 'checked_row', $checked_row));
                    }
                }
            } else {
                $checked_row = implode(',', $this->arrays);
                $session->message(read_xmls('/site/msg/notvalid'));
                return redirect_to(search_for_flag(get_current_page(), 'checked_row', $checked_row));
            }
        }
    }

// Do sorting ----------------------------------------------------
    // Do Move to up
    public static function move_up($id = 0, $page = '', $sql_cond = '') {
        global $database;
        global $session;
        //get this sort id
        $obj = static::find_by_id($id, $sql_cond);
        //get prev sort id
        $obj_prev = static::find_prev_sort_id($obj->sort_id, $sql_cond);
        if (!isset($obj_prev->sort_id)) {
            $session->message(read_xmls('/site/msg/cantmoveup'));
            return redirect_to(search_for_flag($page, 'checked_row', $id));
        } else {

            // update query
            //update prev sort_id -- NULL
            $sql1 = "UPDATE " . static::$table_name . " SET sort_id=0 WHERE sort_id = " . $database->escape_value($obj_prev->sort_id) . " {$sql_cond} ";
            //update curr sort_id = prev sort_id
            $sql2 = "UPDATE " . static::$table_name . " SET sort_id=" . $database->escape_value($obj_prev->sort_id) . " WHERE sort_id = " . $obj->sort_id . " {$sql_cond} ";
            //update prev sort_id = curr sort_id
            $sql3 = "UPDATE " . static::$table_name . " SET sort_id=" . $database->escape_value($obj->sort_id) . " WHERE sort_id = 0 {$sql_cond} ";
           //echo $sql1 ."<br />". $sql2."<br />". $sql3; exit;
            // Run Queries
            $database->query($sql1);
            $database->query($sql2);
            $database->query($sql3);
            $session->message(read_xmls('/site/msg/donesort'));

            return redirect_to(search_for_flag($page, 'checked_row', $id));
        }
    }

    // Do Move to down
    public static function move_down($id = 0, $page = '', $sql_cond = '') {
        global $database;
        global $session;
        //get this sort id
        $obj = static::find_by_id($id, $sql_cond);

        //get prev sort id
        $obj_next = static::find_next_sort_id($obj->sort_id, $sql_cond);
        if (!isset($obj_next->sort_id)) {
            $session->message(read_xmls('/site/msg/cantmovedown'));
            return redirect_to(search_for_flag($page, 'checked_row', $id));
        } else {

            // update query
            $sql1 = "UPDATE " . static::$table_name . " SET sort_id=0 WHERE sort_id = " . $database->escape_value($obj_next->sort_id) . " {$sql_cond} ";
            //update curr sort_id = prev sort_id
            $sql2 = "UPDATE " . static::$table_name . " SET sort_id=" . $database->escape_value($obj_next->sort_id) . " WHERE sort_id = " . $database->escape_value($obj->sort_id) . " {$sql_cond} ";
            //update prev sort_id = curr sort_id
            $sql3 = "UPDATE " . static::$table_name . " SET sort_id=" . $database->escape_value($obj->sort_id) . " WHERE sort_id = 0 {$sql_cond} ";
            // Run Queries
            $database->query($sql1);
            $database->query($sql2);
            $database->query($sql3);
            $session->message(read_xmls('/site/msg/donesort'));
            return redirect_to(search_for_flag($page, 'checked_row', $id));
        }
    }

// Do publishing ----------------------------------------------------
    // Do publish
    public static function publish($id = 0) {
        global $database;
        global $session;
        //get this sort id
        $obj = static::find_by_id($id);
        if ($obj->publish == 0) {
            //update records id
            $sql = "UPDATE " . static::$table_name . " SET publish=1 WHERE id = " . $database->escape_value($obj->id);
            // Run Queries
            $database->query($sql);
        }
    }

    // Do unpublish
    public static function unpublish($id = 0) {
        global $database;
        global $session;
        //get this sort id
        $obj = static::find_by_id($id);
        if ($obj->publish == 1) {
            //update records id
            $sql = "UPDATE " . static::$table_name . " SET publish=0 WHERE id = " . $database->escape_value($obj->id);
            // Run Queries
            $database->query($sql);
        }
    }

    // Do Default
    public static function defaults($id = 0, $page = '', $field, $sql_cond = "") {
        global $database;
        global $session;
        //get this sort id
        $obj = static::find_by_id($id);
        $sql1 = "UPDATE " . static::$table_name . " SET {$field}=0 {$sql_cond}";
        $sql2 = "UPDATE " . static::$table_name . " SET {$field}=1 WHERE id = " . $database->escape_value($obj->id);
        // Run Queries
        $database->query($sql1);
        $database->query($sql2);

        $session->message(read_xmls('/site/msg/sucupdate'));
        return redirect_to(search_for_flag($page, 'checked_row', $id));
    }

}

?>
