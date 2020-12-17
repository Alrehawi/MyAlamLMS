<?php

class MainCategory extends DatabaseObject {

    public static $table_name = "mains";
    protected static $db_fields = array('id', 'title', 'parent_id', 'url_alias', 'content', 'layout', 'lang_id', 'keywords',
        'description', 'paging', 'publish', 'sort_id', 'site_id','subject_sort', 'created', 'updated');
    public $id;
    public $title;
    public $parent_id;
    public $url_alias;
    public $content;
    public $layout;
    public $lang_id;
    public $keywords;
    public $description;
    public $paging;
    public $publish;
    public $sort_id;
    public $site_id;
    public $subject_sort;
    public $created;
    public $updated;
    public static $trans_key = 'main';
    public $errors = array();

    public static function generate_tree_menu($array, $parent = NULL, $indent = "") {
        global $checked_row;
        $has_children = false;
        $indent = $indent . "&nbsp;&nbsp;&nbsp;";
        foreach ($array as $key => $value) {
            if (self::has_child($value['id']) || $value['parent_id'] == '') {
                $ico = "&bull;";
                $ob = "<b>";
                $cb = "</b>";
            } else {
                $ico = "&raquo;";
                $ob = "";
                $cb = "";
            }
            $indent1 = $indent . " " . $ico;
            if ($value['parent_id'] == $parent) {
                if ($has_children === false) {
                    $has_children = true;
                }
                echo "<li><a href='?module=" . Module::find_alias('module_main_subject.php') . "&main_subject=" . $value['url_alias'] . "'>" . $indent1 . "&nbsp;" . $ob . self::find_viewed_language('title', $value['id'], self::$trans_key) . $cb . "</a></li>";

                echo self::generate_tree_menu($array, $key, $indent);
            }
        }
    }

    public function save_main() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->url_alias) || empty($this->paging)) {
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
            if (empty($this->title) || empty($this->url_alias) || empty($this->paging)) {
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
