<?php

class Language extends DatabaseObject {

    public static $table_name = "langs";
    protected static $db_fields = array('id', 'title', 'xml_path', 'alias', 'direction', 'publish', 'defaults', 'css_path', 'phrases', 'font');
    public $id;
    public $title;
    public $xml_path;
    public $alias;
    public $direction;
    public $publish;
    public $defaults;
    public $css_path;
    public $phrases;
    public $font;

    public static $xml;
    public $xml_run;
    public $errors = array();

    //apply language
    public function get_lang() {
        global $database, $session;
        $alias = self::check_alias();
        //echo $alias;exit;
        if (self::count_all() == 0) {
            echo "No Languages Supported !";
            exit;
        }
        if (!empty($alias)) {
            $sql = "SELECT * FROM " . self::$table_name . " WHERE alias='" . $database->escape_value($alias) . "' AND publish=1";
            if (self::find_by_sql($sql) == true) {
                $lang = self::find_by_sql($sql);
                $session->alias = $alias;
            } else {
                echo "No Languages Supported !";
                exit;
            }
        } else if (empty($alias)) {
            $lang = self::get_default_lang();
            $session->alias = $lang[0]->alias;
        } else {
            echo "No Languages Supported !";
            exit;
        }
        $phrases = json_decode($lang[0]->phrases, true);
        return $phrases;

        // libxml_use_internal_errors(true);
        // $xmlfile = FILE_PATH . DSO . 'xml' . DSO . $lang[0]->xml_path;
        // if (file_exists($xmlfile)) {
        //     self::$xml = simplexml_load_file($xmlfile);
        //     return self::$xml;
        // }
    }

    public static function get_lang_style() {
        global $database;
        $in_lang = new Language();
        $default_lang = self::get_default_lang();
        $alias = self::check_alias();
        if (self::count_all() == 0) {
            //echo "";
            $in_lang->errors[] = "No Languages Supported !";
            redirect_to('./?lang=' . $default_lang[0]->alias);
        }

        if (!empty($alias)) {
            $sql = "SELECT * FROM " . self::$table_name . " WHERE alias='" . $database->escape_value($alias) . "' AND publish=1";
            if (self::find_by_sql($sql) == true) {
                $lang = self::find_by_sql($sql);
                if($lang[0]->direction=="rtl"){
                  return 'style_ar.css';
                } else {
                  return 'style.css';
                }

            } else {
                $in_lang->errors[] = "No Languages Supported !";
                redirect_to('./?lang=' . $default_lang[0]->alias);
            }
        } else {
            $in_lang->errors[] = "No Languages Supported !";
            redirect_to('./?lang=' . $default_lang[0]->alias);
        }
    }

    public static function get_default_lang() {
        global $database,$session;
        if(empty($session->site_id)){
          $site_id= SiteConfig::get_default_site_id();
        } else {
          $site_id= $session->site_id;
        }
        $site= SiteConfig::find_by_id($site_id);
        $lang=self::find_by_field('id',$site->lang_id);
        //$sql = "SELECT * FROM " . self::$table_name . " WHERE defaults=1";
        //$lang = self::find_by_sql($sql);
        return $lang;
    }

    public static function get_langs_except_default() {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE defaults=0";
        $lang = self::find_by_sql($sql);
        return $lang;
    }

    public static function check_alias() {
        global $session;
        if (isset($_GET['lang']) && !empty($session->alias)) {
            if (!self::count_by_field('alias', $_GET['lang'])) { // check valid and exist language
                $alias = '';
            } else {
                $session->alias($_GET['lang']);
                $alias = $session->alias;
            }
            if (stristr(get_current_page(), "&", TRUE)) {
                //$link = stristr(get_current_page() , "&" , TRUE);
                $link = str_replace("&lang=" . $alias, "", get_current_page());
                //echo $link ;exit;
            } else {
                $link = stristr(get_current_page(), "?", TRUE);
            }
            redirect_to($link);
        } else if (isset($session->alias)) {
            $alias = $session->alias;
        } else {
            $alias = '';
        }
        return $alias;
    }

    //get current language property's value
    public static function current_lang_attribute($att) {
        global $database, $session;
        //echo $session->alias."wfw";
        //exit;
        $default_lang = self::get_default_lang();
        if (!empty($session->alias))
            $curr_lang = $session->alias;
        else
            $curr_lang = $default_lang[0]->alias;
        $sql = "SELECT * FROM " . self::$table_name . " WHERE alias='" . $database->escape_value($curr_lang) . "'";
        $lang = self::find_by_sql($sql);
        return $lang[0]->$att;
    }

    public static function find_published_langs($sort = "ASC") {
        return self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE publish='1' ORDER BY id " . $sort);
    }

    public static function get_lang_links($class = '') {

        if (SiteConfig::site_config('show_lang') == 1) {
            $language_str= array();
            $languages = Language::find_all('id ASC', "WHERE publish =1 AND alias <> '" . self::current_lang_attribute('alias') . "'");
            foreach ($languages as $language) {
              $href = search_for_flag(get_current_page(), 'lang', $language->alias);
            //  $href = "#";
                   $language_str[] = "<a class='" . $class . "' href='" . $href . "'>" . $language->title . "</a>";
            }
          //  return @join(' | ', $language_str);
            return  $language_str;
        }
    }

    public static function get_target_lang() {

        //if (SiteConfig::site_config('show_lang') == 1) {
          $language_str = "";
          $languages = Language::find_all('id ASC limit 1', "WHERE publish =1 AND alias <> '" . self::current_lang_attribute('alias') . "'");
          $href = search_for_flag(get_current_page(), 'lang', $languages[0]->alias);
          $title= $languages[0]->title;
          return array($title,$href);
      //  }
    }

    public static function change_default_language($old_default_lang_id, $new_default_lang_id) {
        global $database;
        //step1:find arrays of table and objects

        $classes = get_declared_classes();
        $tables = array();
        $objects = array();
        foreach ($classes as $class):
            if (property_exists($class, 'trans_key')) {
                $tables[$class::$table_name] = $class::$trans_key;
                $objects[$class] = $class::$trans_key;
            }
        endforeach;
        //print_r($tables);
        //print_r($objects);
        //step2: Get translate fields of lang that will be default

        $translates = Translator::find_all("id ASC", "WHERE lang_id=" . $new_default_lang_id);
        foreach ($translates as $translate):
            $table = array_search($translate->item_type, $tables);
            $object = array_search($translate->item_type, $objects);
            $table_data = $object::find_by_id($translate->parent_id);
            $field = $translate->field_type;

            @$array_table = array('id' => $translate->parent_id, 'key' => $translate->field_type, 'value' => $table_data->$field, 'lang_id' => $table_data->lang_id);
            @$array_translate = array('id' => @$translate->id, 'parent_id' => @$translate->parent_id, 'field_type' => @$translate->field_type, 'content' => @$translate->content, 'lang_id' => @$translate->lang_id);

            //step3: switching lang_id.

            $sql = "	SELECT DISTINCT TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS	WHERE COLUMN_NAME IN ('lang_id')	AND TABLE_SCHEMA=DB_NAME;";
            $result = $database->query($sql);
            while ($row = $database->fetch_array($result)) {
                if ($row['TABLE_NAME'] == "translator") {
                    $database->query("UPDATE " . $row['TABLE_NAME'] . " SET lang_id=" . $database->escape_value($old_default_lang_id) . "");
                } else {
                    $database->query("UPDATE " . $row['TABLE_NAME'] . " SET lang_id=" . $database->escape_value($new_default_lang_id) . "");
                }
            }

            //step4:Update spacified table and translator by new data

            $sql_table = "UPDATE " . $table . " SET ";
            $sql_table .= $array_table['key'] . "='" . $database->escape_value($array_translate['content']) . "'";
            $sql_table .= " WHERE id=" . $database->escape_value($array_table['id']);
            //echo $sql_table."<br />";
            $database->query($sql_table);

            $sql_trans = "UPDATE translator SET ";
            $sql_trans .= "content='" . $database->escape_value($array_table['value']) . "'";
            $sql_trans .= " WHERE id=" . $database->escape_value($array_translate['id']);
            //echo $sql_trans."<br />";
            $database->query($sql_trans);

        endforeach;

        return true;
    }

    public function save_lang() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->phrases) || empty($this->alias)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars
            else if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else if (strlen($this->alias) >= 50) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else {
                return $this->update();
            }
        } else {

            // check required feilds
            if (empty($this->title) || empty($this->phrases) || empty($this->alias)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }

            // check limit chars
            if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            }
            if (strlen($this->alias) >= 50) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            }
            if ($this->check_entry($this->alias, "alias") > 0) {
                $this->errors[] = read_xmls('/site/msg/aliasexist');
                return false;
            } else {
                return $this->create();
            }
        }
    }

}

$language_init = new Language();
$language_init->get_lang();
?>
