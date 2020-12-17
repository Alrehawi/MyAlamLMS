<?php
global $session;
if ($session->is_logged_in()) {
?>
<li><a href="<?php echo get_relative_link(ADMIN) ?>" target="_self"><i class="fa fa-dashboard"></i> &nbsp;<?php echo read_xmls('/site/adminmenu/links/dashboard') ?></a></li>
  <!-- Menu  -->
  <?php echo Menu::get_children_admin("Null", 1, 0, 1); ?>
<?php } ?>
