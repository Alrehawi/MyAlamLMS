<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
  redirect_to("../login/");
}
$session->check_permission('LanguageView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Language();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Default
if (check_var("defaults", "POST") && check_var("check", "POST") && $session->check_permission('LanguageDefault_STOPPED', '_manage.php')) {
  $def_lang = Language::get_default_lang();
  if (count($_POST['check']) == 1 && ($def_lang[0]->id != $_POST['check'][0])) {
    echo Language::change_default_language($def_lang[0]->id, $_POST['check'][0]);
    return $Action->do_action('defaults', $_POST['check'], get_current_page(), FALSE, '', 'defaults');
    //echo $def_lang[0]->id." - ".$_POST['check'][0];
  }
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('LanguagePublish', '_manage.php')) {
  return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('LanguagePublish', '_manage.php')) {
  return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('LanguageEdit', '_manage.php')) {
  return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}
// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('LanguageDelete', '_manage.php')) {
  return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

$user = User::find_by_id($session->user_id);
$site = SiteConfig::find_by_id($session->site_id);

$cond = " WHERE 1=1 ";
if($user->role_id != 7){
  $cond = " WHERE id={$site->lang_id} ";
}

// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
$per_page = SiteConfig::site_config('paging');
else
$per_page = 20;

$total_count = SiteConfig::count_all($cond);

$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM langs ".$cond;
if (!empty($_GET['s'])) {
  $sql .= "WHERE " . Language::search(@$_GET['s'], array('title', 'alias')) . " ";
}
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$langs = Language::find_by_sql($sql);
?>

<!-- message -->
<div class="row">
  <div class="col-lg-12">
    <?php echo output_message($message); ?>
  </div>
</div>
<!-- /.row -->
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2><?php echo read_xmls('/site/menu/titles/manage'); ?>
          <?php if ($session->has_permission('LanguageAdd')) { ?></h2>
            <a style="color: #fff;"  class="pull-left btn btn-primary" href="_add.php"><?php echo read_xmls('/site/lang/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
          <?php } ?>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
          <form action="<?php echo get_current_page(); ?>" method="POST">
            <?php echo setToken() ?>
            <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
              <thead>
                <tr>
                  <th><?php echo read_xmls('/site/lang/lables/name') ?></th>
                  <th><?php echo read_xmls('/site/lang/lables/alias') ?></th>
                  <th><?php echo read_xmls('/site/lang/lables/direction') ?></th>
                  <th><?php echo read_xmls('/site/lang/lables/publish') ?></th>
                  <th><?php echo read_xmls('/site/lang/lables/default') ?></th>
                  <th><?php echo read_xmls('edit_phrases') ?></th>
                  <!-- <th><?php //echo read_xmls('/site/lang/lables/cssfile') ?></th>
                  <th><?php //echo read_xmls('/site/lang/lables/xmlfile') ?></th> -->
                  <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                </tr>
              </thead>
              <tbody>
                <?php $default_lang = Language::get_default_lang(); foreach ($langs as $lang):?>
                  <tr>
                    <td><?php echo $lang->title; ?></td>
                    <td align="center"><?php echo $lang->alias; ?></td>
                    <td align="center"><?php echo $lang->direction; ?></td>
                    <td align="center"><?php echo show_published($lang->publish); ?></td>
                    <td align="center"><?php echo make_true($lang->defaults); ?></td>
                    <td align="center">
                      <a style="color: #fff;"  class="btn btn-primary" href="_edit_phrases.php?id=<?php echo $lang->id; ?>"><?php echo read_xmls('edit_phrases') ?><i class="fa fa-plus" aria-hidden="true"></i></a>

                      <!-- <td align="center"><a href="<?php //echo FILE_RELATIVE . DS . ADMIN . DS . "file_manager/?edit=" . encoding(SITE_ROOTDSO . DSO . SUB_FOLDER . DSO . "stylesheets" . DSO . $lang->css_path) . "&dir=" . encoding(SITE_ROOTDSO . DSO . SUB_FOLDER . DSO . "stylesheets" . DSO); ?>" target="_blank"><?php //echo $lang->css_path; ?></a></td>
                      <td align="center"><a href="<?php //echo FILE_RELATIVE . DS . ADMIN . DS . "file_manager/?edit=" . encoding(SITE_ROOTDSO . DSO . SUB_FOLDER . DSO . "xml" . DSO . $lang->xml_path) . "&dir=" . encoding(SITE_ROOTDSO . DSO . SUB_FOLDER . DSO . "xml" . DSO); ?>" target="_blank"><?php //echo $lang->xml_path; ?></a></td> -->
                      <td align="center">

                        <input type="checkbox" value="<?php echo $lang->id; ?>" name="check[]" title="<?php echo $lang->title; ?>" <?php if ((is_array($checked_row) && in_array($lang->id, $checked_row)) || check_var("checked_row", "GET") == $lang->id) {
                          echo "checked='checked'";
                        } ?>/></td>

                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

                <table  class="button-table" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                      <table border="0" cellspacing="2" cellpadding="2">
                        <tr>
                          <td align="<?php echo read_xmls('/site/config/otheralign') ?>">
                            <?php if ($session->has_permission('LanguageDefault')) { ?>
                              <input class="btn btn-default" <input name="defaults" type="submit" value="<?php echo read_xmls('/site/adminactions/default') ?>" id="defaults"  class="button"/>
                            <?php } ?>
                            <?php if ($session->has_permission('LanguagePublish')) { ?>
                              <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                              <input class="btn btn-success"  name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                            <?php } ?>
                            <?php if ($session->has_permission('LanguagePublish')) { ?>
                              <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                              <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish" class="button" />
                            <?php } ?>
                            <?php if ($session->has_permission('LanguageEdit')) { ?>
                              <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                              <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            <?php } ?>
                            <?php if ($session->has_permission('LanguageDelete')) { ?>
                              <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                              <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                            <?php } ?>
                          </td>
                        </tr>
                      </table>
                    </div></td>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include_layout_template('admin_footer.php'); ?>
