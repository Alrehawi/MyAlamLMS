<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('AdSectionView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new AdSection();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('AdSectionEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('AdSectionTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('AdSectionDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('AdSectionPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('AdSectionPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}
?>


<?php
// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = AdSection::count_all(" WHERE site_id={$session->site_id} AND  " . AdSection::search(@$_GET['s'], array('title')) . " ");
$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM ads_sections WHERE site_id={$session->site_id} ";
if (!empty($_GET['s'])) {
    $sql .= " AND " . AdSection::search(@$_GET['s'], array('title')) . " ";
}
$sql .= "ORDER BY title ASC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$adsections = AdSection::find_by_sql($sql);
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
                <h2><?php echo read_xmls('/site/adsec/titles/manage') ?></h2>
                <?php if ($session->has_permission('AdSectionAdd')) { ?>
                    <a class="pull-left btn btn-primary" href="_add.php"><?php echo read_xmls('/site/adsec/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/adsec/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/ad/titles/add') ?></th>
                                <th><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($adsections as $adsection):
                                    ?>
                                    <tr>
                                        <td><a href="<?php echo get_relative_link(ADMIN . DS . 'ads' . DS . '_manage.php?adsec_id=' . $adsection->id) ?>"><?php echo AdSection::find_viewed_language('title', intval($adsection->id), AdSection::$trans_key) ?>(<?php echo Ad::count_all("WHERE adsec_id=" . $adsection->id)?>)</a></td>
                                        <td align="center"><a href="<?php echo get_relative_link(ADMIN . DS . 'ads' . DS . '_add.php?adsec_id=' . $adsection->id) ?>"><?php echo show_icon('add.png', read_xmls('/site/ad/titles/add')); ?></a></td>
                                        <td align="center"><?php echo show_published($adsection->publish); ?></td>
                                        <td align="center"><input type="checkbox" value="<?php echo $adsection->id; ?>" name="check[]" title="<?php echo $adsection->title; ?>" <?php
                                            if ((is_array($checked_row) && in_array($adsection->id, $checked_row)) || check_var("checked_row", "GET") == $adsection->id) {
                                                echo "checked='checked'";
                                            }
                                            ?>/>
                                        </td>
                                    </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                     <<table class="button-table" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('AdSectionPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                         <input class="btn btn-success" name="publish"  type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdSectionPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdSectionTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                         <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdSectionEdit')) { ?>
                                         <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdSectionDelete')) { ?>
                                        <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                        <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
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
