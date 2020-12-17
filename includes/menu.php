<?php

class Menu extends DatabaseObject {

    public static $table_name = "menus";
    protected static $db_fields = array('id', 'title', 'parent_id', 'type', 'lang_id', 'sort_id', 'publish', 'page_id',
        'module_id', 'main_id', 'gallery_id', 'url', 'target', 'hide_submenu', 'menu_type', 'permission_id', 'site_id', 'font_icon', 'layout','created', 'updated');
    public $id;
    public $title;
    public $parent_id;
    public $type;
    public $lang_id;
    public $sort_id;
    public $publish;
    public $page_id;
    public $module_id;
    public $main_id;
    public $gallery_id;
    public $url;
    public $target;
    public $hide_submenu;
    public $menu_type;
    public $permission_id;
    public $site_id;
    public $font_icon;
    public $layout;
    public $created;
    public $updated;
    public static $trans_key = 'menu';
    public $errors = array();

    public static function generate_link($id = 0) {
    	$link='';
        if (!empty($id)) {
            $menu = self::find_by_id($id);
            if (!empty($menu->page_id)) {
                $alias = Page::find_field_by_id('url_alias', $menu->page_id);
                $link = "href='./?page={$alias}'";
            } else if (!empty($menu->main_id)) {
                $alias = MainCategory::find_field_by_id('url_alias', $menu->main_id);
                $link = "href='./?module=" . Module::find_alias('module_main_subject.php') . "&main_subject={$alias}'";
            } else if (!empty($menu->gallery_id)) {
                $alias = Gallery::find_field_by_id('url_alias', $menu->gallery_id);
                $link = "href='./?module=" . Module::find_alias('module_gallery.php') . "&gallery={$alias}'";
            } else if (!empty($menu->module_id)) {
                $alias = Module::find_field_by_id('url_alias', $menu->module_id);
                $link = "href='./?module={$alias}'";
            } else if (!empty($menu->url)) {
                $link = "href='{$menu->url}' target='{$menu->target}'";
            } else if (!empty($menu->permission_id)) {
                $page_path = Permission::find_field_by_id('page_path', $menu->permission_id);
                $link = "href='" . get_relative_link(ADMIN . DS . $page_path) . "'";
            }
            return $link;
        }
    }

    public static function admin_link($perm_title){
      if($perm_title){
        $page_path = Permission::find_by_field('title',$perm_title);
        return get_relative_link(ADMIN . DS . $page_path[0]->page_path);
      } else {
        return false;
      }
    }

    public static function generate_pure_link($id = 0) {
        if (!empty($id)) {
            $menu = self::find_by_id($id);
            if (!empty($menu->page_id)) {
                $alias = Page::find_field_by_id('url_alias', $menu->page_id);
                $link = get_relative_link() . "?page={$alias}";
            } else if (!empty($menu->main_id)) {
                $alias = MainCategory::find_field_by_id('url_alias', $menu->main_id);
                $link = get_relative_link() . "?module=" . Module::find_alias('module_main_subject.php') . "&main_subject={$alias}";
            } else if (!empty($menu->gallery_id)) {
                $alias = Gallery::find_field_by_id('url_alias', $menu->gallery_id);
                $link = get_relative_link() . "?module=" . Module::find_alias('module_gallery.php') . "&gallery={$alias}";
            } else if (!empty($menu->module_id)) {
                $alias = Module::find_field_by_id('url_alias', $menu->module_id);
                $link = get_relative_link() . "?module={$alias}";
            } else if (!empty($menu->url)) {
                $link = $menu->url;
            } else if (!empty($menu->permission_id)) {
                $page_path = Permission::find_field_by_id('page_path', $menu->permission_id);
                $link = get_relative_link(ADMIN . DS . $page_path);
            }
            return $link;
        }
    }

    public static function has_child_menu($id = 0) {
        global $database;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE parent_id=" . $database->escape_value($id) . " AND hide_submenu=0";
        $results = $database->query($sql);
        return $database->num_rows($results);
    }

    public static function get_childrens_menu($parent, $level, $prev_level = NULL, $menu_type='' ) {
        global $database, $session;
        if ($menu_type == 0) {
            $cond = "AND site_id={$session->site_id} ";
        } else {
            $cond = "";
        }
        if ($parent == "Null") {
            $sql = "SELECT * FROM " . static::$table_name;
            $sql .= " WHERE menu_type='{$menu_type}' and parent_id IS NULL AND publish=1 AND hide_submenu=0 {$cond} ORDER BY sort_id ASC";
        } else {
            $sql = "SELECT * FROM " . static::$table_name;
            $sql .= " WHERE menu_type='{$menu_type}' and  parent_id=" . $database->escape_value($parent) . "  AND publish=1 AND hide_submenu=0 {$cond} ORDER BY sort_id ASC";
        }
        $tree = static::find_by_sql($sql);
        return $tree;
    }

    public static function multi_columns($id) {
        global $database;
        $node = "";
        $title = "<a  " . self::generate_link($id) . ">" . self::find_viewed_language("title", $id, self::$trans_key) . "</a>";
        $node .= <<<EOD
        <li>{$title}
          <div class="megamenu-panel">
            <div class="row">
EOD;
      $menus = self::get_childrens_menu($id, 1, NULL, 0);
      foreach ($menus as $menu):
        $link=self::generate_link($menu->id);
        $title2=self::find_viewed_language("title", $menu->id, self::$trans_key);
        $node .= <<<EOD

              <ul class="megamenu-list col-lg-2 col-sm-12">
                <li class="megamenu-list-title"> <a {$link}><i class='{$menu->font_icon}'></i> {$title2}</a></li>
EOD;
      $submenus = self::get_childrens_menu($menu->id, 2, NULL, 0);
      foreach ($submenus as $submenu):
        $link3=self::generate_link($submenu->id);
        $title3=self::find_viewed_language("title", $submenu->id, self::$trans_key);
      $node .= <<<EOD
                <li><a {$link3}>{$title3}</a></li>
EOD;
      endforeach;

        $node .= <<<EOD
              </ul>
EOD;
      //self::get_children($menu->id, $level + 1, $prev_level, $menu_type);
      endforeach;
        $node .= <<<EOD
            </div>
          </div>
        </li>
EOD;
return $node;
    }

    public static function get_children($parent, $level, $prev_level = NULL, $menu_type = 0) {

        global $database;
        $class = 'nav-link dropdown-toggle';
        $classsub = 'nav-dropdown';
        $aclass = 'fade';
        $classlis = '';
        $menus = self::get_childrens_menu($parent, $level, $prev_level, $menu_type);

        foreach ($menus as $menu):

          if($menu->layout == 2){
            echo self::multi_columns($menu->id);
          } else {

            //start case: if has child --> assign icon_drop class
            $haschild = self::has_child_menu($menu->id);
            if ($haschild > 0) {
                $classli = $class;
                $classlis = 'nav-item dropdown dropdown-m';
            } else {
                $classli = '';
                $classlis = '';
            }
            // end case
            //start case: if parent menu --> don't have a fade class
            $hasparent = self::has_parent($menu->id);
            if ($hasparent == NULL) {
                $classfade = '';
            } else {
                $classfade = $aclass;
            }
            // end case
            //start case: if parent menu != null and has child --> assign icon_sub class
            if ($hasparent != NULL && $haschild > 0) {
                $classli = $classsub;
            }
            // end case

            if (self::has_child_menu($menu->id) > 0) {
                $prev_level = $level + 1;
            }
            $nodes = "";
            if ($menu->hide_submenu == 0 || $menu->hide_submenu == NULL) {
                $nodes .= "<li>";
                if (self::has_child_menu($menu->id)) {
                    // $getclass = 'class="' . $class . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdow'.$menu->id.'" ';
                    $caret="<span class='caret'></span>";
                } else {
                    $getclass = '';
                    $caret = '';
                }
                $nodes .= "<a  " . self::generate_link($menu->id) . ">" . self::find_viewed_language("title", $menu->id, self::$trans_key) . "</a>";
            }
            if (self::has_child_menu($menu->id)) {
                $nodes .= "<ul class='" . $classsub . "'>";
            } else {
                $nodes .= "</li>";
            }
            echo $nodes;
            self::get_children($menu->id, $level + 1, $prev_level, $menu_type);
          }
        endforeach;
        if ((!empty($menu->parent_id) && !empty($prev_level) && $prev_level == $level) || ($prev_level == $level + 1 && !empty($menu->parent_id) )) {
            echo "</ul></li>";
            $prev_level = NULL;
        }
    }

    public static function get_children_admin($parent, $level, $prev_level = NULL, $menu_type = 0) {

        global $database, $session;
        $class = '';
        $classsub = 'nav nav-second-level';
        $aclass = 'fade';
        $classlis = $class;
        $menus = self::get_childrens_menu($parent, $level, $prev_level, $menu_type);
        //if ($session->has_permission('MenuView')) {
        foreach ($menus as $menu):
            $haschild = self::has_child_menu($menu->id);
            // end case
            //start case: if parent menu --> don't have a fade class
            $hasparent = self::has_parent($menu->id);
            if ($hasparent == NULL) {
                $classfade = '';
            } else {
                $classfade = $aclass;
            }
            // end case
            //start case: if parent menu != null and has child --> assign icon_sub class
            if ($hasparent != NULL && $haschild > 0) {
                $classli = $classsub;
            }
            // end case

            if (self::has_child_menu($menu->id) > 0) {
                $prev_level = $level + 1;
            }
            $nodes = "";
            if ($menu->hide_submenu == 0 || $menu->hide_submenu == NULL) {
                $perSet = '';
                if (!empty($menu->permission_id)) {
                    $per = Permission::find_by_id($menu->permission_id);
                    $perSet = $per->title;
                }



                $nodes .= "<li>";
                if (self::has_child_menu($menu->id)) {
                    $getclass = 'class="' . $class . '"';
                    $menu_item = "<span class='fa arrow pull-left'></span><i class='fa ".$menu->font_icon."'></i>&nbsp; " . self::find_viewed_language("title", $menu->id, self::$trans_key);
                } else {
                    $getclass = '';
                    $menu_item = "<i class='fa ".$menu->font_icon."'></i> &nbsp;".self::find_viewed_language("title", $menu->id, self::$trans_key);
                }
                $nodes .= "<a ". self::generate_link($menu->id) . $getclass .">" . $menu_item . "</a>";
            }
            if (self::has_child_menu($menu->id)) {
                $nodes .= "<ul class='" . $classsub . "'><li>";
            } else {
                $nodes .= "</li>";
            }
            if (!$menu->permission_id || ($menu->permission_id && $session->has_permission($perSet))) {
                echo $nodes;
                self::get_children_admin($menu->id, $level + 1, $prev_level, $menu_type);
            }

        endforeach;
        if ((!empty($menu->parent_id) && !empty($prev_level) && $prev_level == $level) || ($prev_level == $level + 1 && !empty($menu->parent_id))) {
            echo "</li></ul></li>";
            $prev_level = NULL;
        }
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

    public static function get_children_all($parent, $level, $prev_level = NULL, $class = '', $aclass = "") {
        global $database;
        $menus = self::get_childrens($parent, $level, $prev_level);
        $classlis = '';
        foreach ($menus as $menu):
            if (self::has_child($menu->id)) {
                $prev_level = $level + 1;
            }
            $nodes = "";
            $nodes .= "<li class='{$classlis}'>";
            $nodes .= "<a class='" . $class . "' " . self::generate_link($menu->id) . ">" . self::find_viewed_language("title", $menu->id, self::$trans_key) . "</a>";
            if (self::has_child($menu->id)) {
                $nodes .= "<ul class='" . @$classsub . "'>";
            } else {
                $nodes .= "</li>";
            }
            echo $nodes;
            self::get_children($menu->id, $level + 1, $prev_level, $class, $aclass);
        endforeach;
        if ((!empty($menu->parent_id) && !empty($prev_level) && $prev_level == $level) || ($prev_level == $level + 1 && !empty($menu->parent_id) )) {
            echo "</ul></li>";
            $prev_level = NULL;
        }
    }

    public static function checkmenu($type, $alias) {
        global $session;
        $value = self::find_object_id($type, $alias);
        $field = $type . "_id";
        $menucount = self::count_all("WHERE publish=1 AND site_id={$session->site_id} AND " . $field . "=" . $value);
        if ($menucount > 0) {
            $menu = self::find_by_field($field, $value);
            return $menu[0]->id;
        } else {
            return false;
        }
    }

    public static function get_parent_id($id){
      $menuRow=self::find_by_id($id);
      return $menuRow->parent_id;
    }
    public function save_menu() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title) || empty($this->type)) {
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
            if (empty($this->title) || empty($this->type)) {
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
