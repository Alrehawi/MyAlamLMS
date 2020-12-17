<?php

class Page extends DatabaseObject {

    public static $table_name = "pages";
    protected static $db_fields = array('id', 'title','content', 'url_alias', 'sort_id', 'publish', 'lang_id', 'keywords', 'description', 'module_id',
        'home', 'contact', 'module_id', 'counter', 'site_id', 'created', 'updated');
    public $id;
    public $content;
    public $title;
    public $url_alias;
    public $sort_id;
    public $publish;
    public $lang_id;
    public $keywords;
    public $description;
    public $module_id;
    public $home;
    public $contact;
    public $counter;
    public $site_id;
    public $created;
    public $updated;
    public static $trans_key = 'page';
    public $errors = array();

    public static function get_home_link($comeFrom='') {
        global $session;
        //echo $comeFrom;exit;
        if(empty($session->site_id)){
          $siteConfig = SiteConfig::find_all("id ASC limit 1");
          $session->site_id($siteConfig[0]->id);
          $session->site_id=$siteConfig[0]->id;
        }
        $home = self::find_all('id ASC', "WHERE home=1 AND publish=1 AND site_id={$session->site_id}");
        $home = $home[0];
        if (self::count_all("WHERE home=1 AND publish=1 AND site_id={$session->site_id}")) {
            return FILE_RELATIVES."/?page=" . $home->url_alias;
        } else {
            $session->message(read_xmls('/site/frontend/msg/homenotassigned'));
            redirect_to(FILE_RELATIVES.DS.'error.php?e=get_home_link');
        }
    }

    public static function check_home($alias) {
         global $session;
        if (self::count_all("WHERE url_alias='" . $alias . "' AND home=1 AND publish=1 AND site_id={$session->site_id}")) {
            return true;
        } else {
            return false;
        }
    }


    public function save_page() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->url_alias)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            $current_alias = self::find_by_id($this->id);
            if ($this->url_alias != $current_alias->url_alias && $this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
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
            if (empty($this->title) || empty($this->url_alias)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }

            if ($this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
                return false;
            }
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
