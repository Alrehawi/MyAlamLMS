<?php

class Layout extends DatabaseObject {

    public static $table_name = "layout";
    protected static $db_fields = array('id', 'page_id', 'module_id', 'defaults', 'top_side', 'left_side', 'right_side', 'bottom_side', 'updated', 'site_id');
    public $id;
    public $page_id;
    public $module_id;
    public $defaults;
    public $top_side;
    public $left_side;
    public $right_side;
    public $bottom_side;
    public $updated;
    public $site_id;
    public $errors = array();

    public static function doubleExplode($del1, $del2, $array) {
        $array1 = explode("$del1", $array);
        foreach ($array1 as $key => $value) {
            $array2 = explode("$del2", $value);
            foreach ($array2 as $key2 => $value2) {
                $array3[] = $value2;
            }
        }
        $afinal = array();
        $afinal['top'] = array();
        $afinal['left'] = array();
        $afinal['right'] = array();
        $afinal['bottom'] = array();
        for ($i = 0; $i <= count($array3); $i += 2) {
            if (@$array3[$i] != "") {
                if (trim($array3[$i]) == "top") {
                    $afinal['top'][] = trim($array3[$i + 1]);
                } else if (trim($array3[$i]) == "left") {
                    $afinal['left'][] = trim($array3[$i + 1]);
                } else if (trim($array3[$i]) == "right") {
                    $afinal['right'][] = trim($array3[$i + 1]);
                } else if (trim($array3[$i]) == "bottom") {
                    $afinal['bottom'][] = trim($array3[$i + 1]);
                }
            }
        }
        return $afinal;
    }

    public static function find_layout_in($side = array()) {
        if (is_array($side)) {
            $lis = "";
            foreach ($side as $node):
                $lis .= "<li id='" . $node . "'>" . Plugin::find_viewed_language('title', $node, Plugin::$trans_key) . "</li>";
            endforeach;
        }
        return $lis;
    }

    public static function perventedPlugins($id = 0) {
        global $session;
        if (!empty($id)) {
            $query[] = '';
            $obj = self::find_by_id($id," AND site_id={$session->site_id}");
            if (!empty($obj->top_side)) {
                $plugins_top = explode(',', $obj->top_side);
                foreach ($plugins_top as $top):
                    $query[] = $top;
                endforeach;
            }
            if (!empty($obj->left_side)) {
                $plugins_left = explode(',', $obj->left_side);
                foreach ($plugins_left as $left):
                    $query[] = $left;
                endforeach;
            }
            if (!empty($obj->right_side)) {
                $plugins_right = explode(',', $obj->right_side);
                foreach ($plugins_right as $right):
                    $query[] = $right;
                endforeach;
            }
            if (!empty($obj->bottom_side)) {
                $plugins_bottom = explode(',', $obj->bottom_side);
                foreach ($plugins_bottom as $bottom):
                    $query[] = $bottom;
                endforeach;
            }
            return join(" AND id <> ", $query);
        }
    }

}

?>