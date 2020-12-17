<?php
global $plugin_menu_stages,$database;
/*

      $menuItems=Menu::get_childrens_menu(195, 1);
      // echo "<pre>";
      // var_dump($menuItems);

      $plugin_menu_stages = "<section class='one-third'><ul class='contact-info-widget'>";
      foreach ($menuItems as $menuItem ) {
          $plugin_menu_stages .=  "<li><a ".Menu::generate_link($menuItem->id)." target='{$menuItem->target}'>{$menuItem->title}</li>";
      }
      $plugin_menu_stages .= "</ul></section>";

*/

if(@$_GET['menu_par']){
  $menu_par = intval($database->escape_value($_GET['menu_par']));
  $menuItemsCheck = Menu::count_all(" WHERE id={$menu_par}");

  if(@$menu_par && $menuItemsCheck> 0){
    $menuParent=Menu::get_parent_id($menu_par);
    if(@$menuParent){
      $menuItems=Menu::get_childrens_menu($menuParent, 1);
      // echo "<pre>";
      // var_dump($menuItems);

      $plugin_menu_stages = "<section class='one-third'><ul class='contact-info-widget'>";
      foreach ($menuItems as $menuItem ) {
          $plugin_menu_stages .=  "<li><a ".Menu::generate_link($menuItem->id)." target='{$menuItem->target}'>{$menuItem->title}</li>";
      }
      $plugin_menu_stages .= "</ul></section>";
    }
  }
}
//$plugin_menu_stages=0;
?>
