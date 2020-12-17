<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('AdView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<script type="text/javascript">

    jQuery_1_3_2(document).ready(function () {
        jQuery_1_3_2("a#single").fancybox({
            'opacity': true,
            'overlayShow': true,
            'overlayColor': '#333',
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'titlePosition': 'over'
        });
    });
</script>

<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Ad();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('AdEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('AdTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('AdDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('AdPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('AdPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Move Up
if (check_var("sort_up", "POST") && check_var("adsec_id", "POST") && check_var("check", "POST") && $session->check_permission('AdMove', '_manage.php')) {
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, " AND adsec_id=" . $_POST['adsec_id'] . " ");
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("adsec_id", "POST") && check_var("check", "POST") && $session->check_permission('AdMove', '_manage.php')) {
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE, " AND adsec_id=" . $_POST['adsec_id'] . " ");
}
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
             <h2><?php echo read_xmls('/site/ad/titles/manage') ?></h2>
                <?php if ($session->has_permission('AdAdd')) { ?>
                    <a style="color: #fff;"  class="pull-left btn btn-primary" href="_add.php?adsec_id=<?php echo trim(@$_GET['adsec_id']) ?>"><?php echo read_xmls('/site/ad/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <form name="assign" action="<?php echo get_current_page(); ?>" method="POST">
                <?php echo read_xmls('/site/adsec/lables/name'); ?>:
                <select  class="form-control" name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'adsec_id', ''); ?>')">
                    <option value=""><?php echo read_xmls('/site/adsec/lables/name'); ?></option>
                    <?php
                    $get_categories = AdSection::find_all("title ASC","WHERE site_id={$session->site_id}");
                    foreach ($get_categories as $adsec) {
                        ?>
                        <option value="<?php echo $adsec->id ?>"<?php
                        if (check_var('adsec_id', 'GET') == $adsec->id) {
                            echo ' selected';
                        }
                        ?>><?php echo $adsec->title ?>(<?php echo Ad::count_all("WHERE adsec_id=" . $adsec->id) ?>)</option>
                            <?php } ?>
                </select>
            </form>
            <br />

<?php
if (isset($_GET['adsec_id']) && !empty($_GET['adsec_id'])) {
    $adsec_id = intval($_GET['adsec_id']);
// start pagination
    $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
    if (SiteConfig::site_config('paging'))
        $per_page = SiteConfig::site_config('paging');
    else
        $per_page = 20;
    $total_count = Ad::count_all("WHERE adsec_id=" . $database->escape_value($adsec_id) . " AND (" . Ad::search(@$_GET['s'], array('title')) . ") ");
    $pagination = new Pagination($page, $per_page, $total_count);

    $sql = "SELECT * FROM ads where adsec_id=" . $adsec_id . " ";
    if (!empty($_GET['s'])) {
        $sql .= "AND (" . Ad::search(@$_GET['s'], array('title')) . ") ";
    }
    $sql .= "ORDER BY sort_id ASC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $ads = Ad::find_by_sql($sql);
    ?>
    <?php
    $hidden_input = "<input type='hidden' name='adsec_id' value='" . @$adsec_id . "' />";
    ?>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken();
                  echo $hidden_input; ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/ad/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/ad/lables/photo') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php foreach ($ads as $ad): $ad_title = Ad::find_viewed_language('title', intval($ad->id), Ad::$trans_key);?>
                                <tr>
                                    <td><?php echo $ad_title ?></td>
                                    <td align="center">
                                        <?php
                                        if (!empty($ad->photo)) {
                                            if ($ad->ad_type == 'flash') {
                                                echo "<a href='" . File::get_file($ad->photo) . "' target='_blank'>" . show_icon('flash.png') . "</a>";
                                            } else {
                                                ?>
                                                <a title="<?php $ad_title ?>" href="<?php echo Photographs::get_image($ad->photo, 'larg'); ?>"  id="single">
                                                    <img src="<?php echo Photographs::get_image($ad->photo, 'small'); ?>" width="50" /></a>
                                                <?php
                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                    <td align="center"><?php echo show_published($ad->publish); ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $ad->id; ?>" name="check[]" title="<?php echo $ad->title; ?>" <?php
                                        if ((is_array($checked_row) && in_array($ad->id, $checked_row)) || check_var("checked_row", "GET") == $ad->id) {
                                            echo "checked='checked'";
                                        }
                                        ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                     <table class="button-table" style="float: right;" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('AdMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  />
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                        <input class="btn btn-success" name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                        <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdEdit')) { ?>
                                        <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('AdDelete')) { ?>
                                        <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                        <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"/>
                                    <?php } ?>
                                </div></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>


<?php } include_layout_template('admin_footer.php'); ?>
