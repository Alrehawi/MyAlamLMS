<?php

class SiteConfig extends DatabaseObject {

    public static $table_name = "site_config";
    protected static $db_fields = array('id', 'title', 'email', 'offline', 'offline_msg', 'seo', 'paging', 'show_lang', 'google_analytics',
        'keywords', 'description', 'lang_id', 'facebook', 'twitter', 'youtube', 'copyrights', 'backgrounds',
        'flickr','google_plus','linkedin', 'updated', 'phone', 'address', 'counter', 'url_alias', 'show_sites', 'publish', 'logo_path', 'slogan_path', 'elearning_link', 'school_dues_link', 'registration_link', 'jobs_link', 'live_broadcast_link','default_site');
    public $id;
    public $title;
    public $email;
    public $offline;
    public $offline_msg;
    public $seo;
    public $paging;
    public $show_lang;
    public $google_analytics;
    public $keywords;
    public $description;
    public $lang_id;
    public $facebook;
    public $twitter;
    public $youtube;
    public $copyrights;
    public $backgrounds;
    public $flickr;
    public $google_plus;
    public $linkedin;
    public $updated;
    public $phone;
    public $address;
    public $counter;
    public $url_alias;
    public $show_sites;
    public $publish;
    public $logo_path;
    public $slogan_path;
    public $elearning_link;
    public $school_dues_link;
    public $registration_link;
    public $jobs_link;
    public $live_broadcast_link;
    public $default_site;

    public static $trans_key = 'config';
    public $errors = array();

    //find site config items
    public static function site_config($item) {
        global $session;
        $get_record = self::find_all("id ASC", " WHERE id={$session->site_id}");
        $get_record = $get_record[0];
        return $get_record->$item;
    }

    public static function get_default_site_id(){
      $site = SiteConfig::find_by_field('default_site','1');
      return $site[0]->id;
    }

    public static function change_default_site($newSiteId){
      global $session;
      if($newSiteId){
        $session->site_id = $newSiteId;
        $session->site_id($newSiteId);
      }
    }

    public function save_site_config() {
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
            // check required feilds
            if (empty($this->title) || empty($this->email) || empty($this->paging)) {
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
            if (empty($this->title) || empty($this->url_alias)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }

            if ($this->check_entry($this->url_alias, "url_alias") > 0) {
                $this->errors[] = $this->url_alias . ": " . read_xmls('/site/msg/urlalias');
                return false;
            }
            // check required feilds
            if (empty($this->title) || empty($this->email) || empty($this->paging)) {
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
