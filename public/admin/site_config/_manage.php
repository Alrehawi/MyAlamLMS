<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SiteConfigView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new SiteConfig();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('SiteConfigEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('SiteConfigDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('SiteConfigPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('SiteConfigPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('SiteConfigTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}


$user = User::find_by_id($session->user_id);
$cond = " WHERE 1=1 ";
if($user->role_id != 7){
  $cond = " WHERE id={$session->site_id} ";
}
$cond2 = " and  (" . SiteConfig::search(@$_GET['s'], array('title')) . ")   ";

// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = SiteConfig::count_all($cond . $cond2);

$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM site_config " . $cond;
if (!empty($_GET['s'])) {
    $sql .= $cond2;
}
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$siteconfigs = SiteConfig::find_by_sql($sql);
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
                <h2><?php echo read_xmls('/site/siteconfigs/titles/manage') ?></h2>
                <?php if ($session->has_permission('SiteConfigAdd')) { ?>
                    <a style="color: #fff;"  class="pull-left btn btn-primary"  href="_add.php"><?php echo read_xmls('/site/siteconfigs/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                              <th><?php echo read_xmls('/site/siteconfigs/lables/title') ?></th>
                                  <th><?php echo read_xmls('/site/page/lables/link') ?></th>
                                  <th><?php echo read_xmls('default_language') ?></th>
                                    <th><?php echo read_xmls('default_site') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($siteconfigs as $siteconfig):
                                ?>
                                <tr>
                                  <td><?php echo SiteConfig::find_viewed_language('title', intval($siteconfig->id), SiteConfig::$trans_key) ?></td>

                                    <td align="center" valign="middle"><input type="text" value="<?php echo FILE_RELATIVE . DS . "?site=" . @$siteconfig->url_alias ?>" style="width:350px" /> </td>
                                    <td><?php echo $siteconfig->lang_id; ?></td>
                                      <td><?php echo make_true($siteconfig->default_site); ?> </td>
                                    <td align="center"><?php echo show_published($siteconfig->publish); ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo @$siteconfig->id; ?>" name="check[]" title="<?php echo SiteConfig::find_viewed_language('title', intval($siteconfig->id), SiteConfig::$trans_key) ?>" <?php
                                        if (@in_array(@$siteconfig->id, @$checked_row)) {
                                            echo "checked='checked'";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <table class="button-table" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                        <?php if ($session->has_permission('SiteConfigPublish')) { ?>
                                            <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                            <input class="btn btn-success" name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                        <?php } ?>
                                        <?php if ($session->has_permission('SiteConfigPublish')) { ?>
                                            <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                            <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish" class="button" />
                                        <?php } ?>
                                        <?php if ($session->has_permission('SiteConfigTranslate')) { ?>
                                            <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                            <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                        <?php } ?>
                                        <?php if ($session->has_permission('SiteConfigEdit')) { ?>
                                            <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                            <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                        <?php } ?>
                                        <?php if ($session->has_permission('SiteConfigDelete')) { ?>
                                            <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                            <input class="btn btn-danger" name="dell" id='delete' type="submit" onClick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>" class="button">
                                        <?php } ?>
                                </div></td>
                            </tr>
                     </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
