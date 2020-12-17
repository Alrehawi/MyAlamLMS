<?php

class Search extends DatabaseObject {

    public static $table_name = "search_view";
    protected static $db_fields = array('title', 'id', 'url_alias', 'lang_id', 'keywords', 'description', 'content'
        , 'trans_title', 'trans_content', 'trans_title_lang_id', 'trans_content_lang_id', 'trans_keywords', 'trans_description', 'item_type');
    public $title;
    public $id;
    public $url_alias;
    public $lang_id;
    public $keywords;
    public $description;
    public $content;
    public $trans_title;
    public $trans_content;
    public $trans_title_lang_id;
    public $trans_content_lang_id;
    public $trans_keywords;
    public $trans_description;
    public $item_type;

    public function get_results($title = "", $description = "", $url = "") {

        if (!empty($title)) {
            $result = "<div class='title'><a href='{$url}'>{$title}</a></div>";
            if ($url != '') {
                $result .= "<div class='link'> {$url} </div>";
            }
            $result .= "<div class='desc'>{$description}</div>";
            $result .= "<hr>";
            return $result;
        }
    }

}

?>