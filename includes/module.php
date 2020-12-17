<?php

class Module extends DatabaseObject {

    public static $table_name = "modules";
    protected static $db_fields = array('id', 'title', 'url_alias', 'related_class', 'lang_id', 'publish', 'keywords', 'description', 'site_id', 'created', 'updated');
    public $id;
    public $title;
    public $url_alias;
    public $related_class;
    public $lang_id;
    public $publish;
    public $keywords;
    public $description;
    public $site_id;
    public $created;
    public $updated;
    public static $trans_key = 'module';
    public $errors = array();

    public function save_module() {
	    global $session;
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->url_alias) || empty($this->related_class)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            $current_alias = self::find_by_id($this->id);
            if ($this->url_alias != $current_alias->url_alias && $this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
                return false;
            }
            if ($this->related_class != $current_alias->related_class && $this->check_entry($this->related_class, "related_class"," AND site_id={$session->site_id} ") > 0) {
                $this->errors[] = $this->related_class . ": " . read_xmls('/site/msg/relatedclass');
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
            if (empty($this->title) || empty($this->url_alias) || empty($this->related_class)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }

            if ($this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
                return false;
            }
            if ($this->check_entry($this->related_class, "related_class"," AND site_id={$session->site_id} ") > 0) {
                $this->errors[] = $this->related_class . ": " . read_xmls('/site/msg/relatedclass');
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