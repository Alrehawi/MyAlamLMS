<?php

class Plugin extends DatabaseObject {

    public static $table_name = "plugins";
    protected static $db_fields = array('id', 'title', 'has_page', 'has_menu', 'menu_id', 'lang_id', 'related_class', 'publish', 'show_title', 'css_class',
        'css_custom', 'html_id', 'content', 'javascript', 'site_id', 'related_sec', 'ads_section_id', 'gallery_id', 'main_id', 'created', 'updated');
    public $id;
    public $title;
    public $has_page;
    public $has_menu;
    public $menu_id;
    public $lang_id;
    public $related_class;
    public $publish;
    public $show_title;
    public $css_class;
    public $css_custom;
    public $html_id;
    public $content;
    public $javascript;
    public $site_id;
    public $related_sec;
    public $ads_section_id;
    public $gallery_id;
    public $main_id;
    public $created;
    public $updated;
    public static $trans_key = 'plugin';
    public $errors = array();

    public static function get_plugins($array = array(), $side = "") {
        global $session, $sec_id;
        $ip=$_SERVER['REMOTE_ADDR'];
        $ipsub = substr($ip,0,6);

        if (is_array($array) && !empty($array)) {
            foreach ($array as $plugin):
                $show=true;
                $get_plugin = self::find_by_id(intval($plugin), "AND publish=1 AND site_id={$session->site_id}");
                if($get_plugin->id==54){
                if($ipsub!='172.16' && $ip!='37.224.114.177' && $ip!='82.147.193.156'  && $ip!='::1' ){
                  $show=false;
                }
              }
                if (self::count_by_field('id', intval($plugin), "AND publish=1 AND site_id={$session->site_id}")) {
                    if ($get_plugin->has_menu == 1 && !empty($get_plugin->menu_id)) {

                        echo "<div ";
                        if ($get_plugin->css_class)
                            echo " class='" . $get_plugin->css_class . "'";
                        if ($get_plugin->css_custom)
                            echo " style='" . $get_plugin->css_custom . "'";
                        if ($get_plugin->html_id)
                            echo " id='" . $get_plugin->html_id . "'";
                        echo ">";
                        echo '<aside id="sidebar" class="widget_style">';
                        echo '<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static;">';
                        echo '<div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">';
                        if ($get_plugin->show_title == 1) {
                            echo '<div class="widget-top">';
                            echo "<h1>" . Plugin::find_viewed_language('title', $get_plugin->id, Plugin::$trans_key) . "</h1>";
                            echo '<div class="stripe-line"></div>';
                            echo '</div>';
                        }
                        echo '<div class="widget-container">';
                        echo "<ul class=\"product-categories\">";
                        echo Menu::get_children_all($get_plugin->menu_id, 1);
                        echo "</ul>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</aside>";
                        echo "</div>";
                        echo '<div class="clear"></div>';

                    } else {
                      if($show==true){
                        echo $get_plugin->javascript;
                        echo "<aside ";
                        if ($get_plugin->css_class)
                            echo " class='" . $get_plugin->css_class . "'";
                        if ($get_plugin->css_custom)
                            echo " style='" . $get_plugin->css_custom . "'";
                        if ($get_plugin->html_id)
                            echo " id='" . $get_plugin->html_id . "'";
                        echo ">";
                        if ($get_plugin->show_title == 1) {
                            echo "<div class=\"widget-top\"><h1>" . Plugin::find_viewed_language('title', $get_plugin->id, Plugin::$trans_key) . "</h1><div class=\"stripe-line\"></div></div>";
                        }
                        if ($get_plugin->has_page == 1 && !empty($get_plugin->related_class)) {
                            if ($get_plugin->related_sec == 'adsec' && !empty($get_plugin->ads_section_id)) {
                                $sec_id = $get_plugin->ads_section_id;
                            }
                            if ($get_plugin->related_sec == 'gallery' && !empty($get_plugin->gallery_id)) {
                                $sec_id = $get_plugin->gallery_id;
                            }
                            if ($get_plugin->related_sec == 'mains' && !empty($get_plugin->main_id)) {
                                $sec_id = $get_plugin->main_id;
                            }
                            echo include_layout_plugin($get_plugin->related_class);
                        }
                        if (Plugin::find_viewed_language('content', $get_plugin->id, Plugin::$trans_key)) {
                            echo "<div class=\"widget-container\">";
                            echo Plugin::find_viewed_language('content', $get_plugin->id, Plugin::$trans_key);
                            echo "</div>";
                        }
                        echo "</aside>";
                        //if($side=="left" || $side=="right"){echo "<div style='clear:both;'></div>";}
                      }
                    }
                }
            endforeach;
        }
    }

    public function save_plugin() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title)) {
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
            if (empty($this->title)) {
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
