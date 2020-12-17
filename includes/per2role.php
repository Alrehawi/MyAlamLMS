<?php

class Per2role extends DatabaseObject {

    public static $table_name = "role_per";
    protected static $db_fields = array('roles_id', 'pers_id');
    public $roles_id;
    public $pers_id;
    public $errors = array();

    // If checked return 1 else return 0
    public static function is_checked($role = 0, $perm = 0) {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE roles_id='" . $database->escape_value($role) . "' AND pers_id='" . $database->escape_value($perm) . "'";
        $results = $database->query($sql);
        return $database->num_rows($results);
    }

    // get all permissions on the user's role
    public static function perms_per_role($role = 0) {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE roles_id='" . $database->escape_value($role) . "'";
        $perms = self::find_by_sql($sql);
        $all = '';
        foreach ($perms as $perm) {
            $get_per = Permission::find_by_id($perm->pers_id);
            $all .= $get_per->title . ',';
        }
        $all = substr($all, 0, -1);
        return $all;
    }

    // delete none used permissions
    public static function drop_perms($role = 0) {
        global $database;
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE roles_id=" . $database->escape_value($role);
        $database->query($sql);
    }

    // delete assigned permissions when deleting whole permission
    public static function drop_assigned_perm($perm = 0) {
        global $database;
        $sql = "DELETE FROM " . self::$table_name;
        $sql .= " WHERE pers_id=" . $database->escape_value($perm);
        $database->query($sql);
    }

    // Save checked values in DB
    public function save_per2role() {
        global $database;

        if (empty($this->pers_id)) {
            $this->errors[] = read_xmls('/site/msg/atleastone');
            return false;
        }
        if (isset($this->roles_id)) {
            // drop all assigned perms
            self::drop_perms($this->roles_id);
            $attributes = $this->sanitized_attriutes();
            $sql = "INSERT INTO " . self::$table_name . " (";
            $sql .= join(", ", array_keys($attributes));
            $sql .= ") VALUES ";
            foreach ($this->pers_id as $checked_perms) {
                if (self::is_checked($this->roles_id, $checked_perms) == 0) {
                    @$sql_all .= "(" . $this->roles_id . "," . $checked_perms . ") ,";
                }
            }
            $sql.= substr($sql_all, 0, -1);
            $sql .=";";

            if ($database->query($sql)) {
                $this->id = $database->insert_id();
                return true;
            } else {
                return false;
            }
        }
    }

}

?>