<?php

require_once("../includes/initialize.php");
echo get_css(Language::get_lang_style());
echo get_js('global.js');
echo get_js('general.js');

echo include_layout_template('plugins' . DS . 'plugin_login.php');
?>