<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PhotoView', '../');
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
$Action = new Photographs();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('PhotoEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Move Up
if (check_var("sort_up", "POST") && check_var("check", "POST") && $session->check_permission('PhotoMove', '_manage.php')) {
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, " AND site_id={$session->site_id} AND parent_type='" . $_POST['photo_sec'] . "' ");
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("check", "POST") && $session->check_permission('PhotoMove', '_manage.php')) {
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE, " AND site_id={$session->site_id} AND parent_type='" . $_POST['photo_sec'] . "' ");
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('PhotoPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('PhotoPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('PhotoDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}
?>

  <!-- message -->
<div class="row">
    <div class="col-lg-12">
        <?php echo output_message($message); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
         <?php
                if (isset($_GET['photo_sec']) && !empty($_GET['photo_sec'])) {
                    $photo_sec = $_GET['photo_sec'];

                // start pagination
                    $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
                    if (SiteConfig::site_config('paging'))
                        $per_page = SiteConfig::site_config('paging');
                    else
                        $per_page = 20;
                    $total_count = Photographs::count_all("WHERE site_id={$session->site_id} AND parent_type='" . $database->escape_value($photo_sec) . "' AND (" . Photographs::search(@$_GET['s'], array('filename', 'caption')) . ") ");
                    $pagination = new Pagination($page, $per_page, $total_count);

                    $sql = "SELECT * FROM photographs WHERE site_id={$session->site_id} ";
                    $sql .= " AND parent_type='" . $photo_sec . "' ";
                    if (!empty($_GET['s'])) {
                        $sql .= "AND (" . Photographs::search(@$_GET['s'], array('filename', 'caption')) . ") ";
                    }
                    $sql .= " ORDER BY sort_id DESC ";
                    $sql .= " LIMIT {$per_page} ";
                    $sql .= " OFFSET {$pagination->offset()}";

                    $photos = Photographs::find_by_sql($sql);
                    ?>
                    <?php
                    $hidden_input = "<input type='hidden' name='photo_sec' value='" . @$photo_sec . "' />";
                ?>
                <form name="assign" action="<?php echo get_current_page(); ?>" method="POST">
                    <select  class="form-control" name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'photo_sec', ''); ?>')">
                        <option value=""><?php echo read_xmls('/site/photos/lables/select') ?></option>
                        <option value="admin"<?php
                        if (check_var('photo_sec', 'GET') == 'admin') {
                            echo ' selected';
                        }
                        ?>><?php echo read_xmls('/site/photos/lables/admin') ?></option>
                                <?php
                                $photo_types = Photographs::find_by_sql("SELECT DISTINCT parent_type from photographs WHERE (parent_type != 'admin' and parent_type != 'config') AND site_id={$session->site_id}");
                                foreach ($photo_types as $photo_type):
                                    ?>
                            <option value="<?php echo $photo_type->parent_type; ?>" <?php if ($photo_type->parent_type == @$_GET['photo_sec']) echo "selected"; ?>><?php echo read_xmls('/site/' . $photo_type->parent_type . '/titles/main'); ?></option>
                        <?php endforeach; ?>
                    </select>
                </form><br>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h2><?php echo read_xmls('/site/photos/titles/manage') ?></h2>
                    <?php if ($session->has_permission('PhotoAdd')) { ?>
                        <a style="color: #fff"  class="pull-left btn btn-primary"  href="_add.php"><?php echo read_xmls('/site/photos/titles/add') ?><i class="fa fa-plus"></i></a>
                    <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
               <form action="<?php echo get_current_page(); ?>" method="POST">
                 <?php echo setToken() ?>
                 <?php echo $hidden_input?>
                     <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/photos/lables/image') ?></th>
                                <th><?php echo read_xmls('/site/photos/lables/caption') ?></th>
                                <th><?php echo read_xmls('/site/photos/lables/link') ?></th>
                                <th><?php echo read_xmls('/site/photos/lables/size') ?></th>
                                <th><?php echo read_xmls('/site/photos/lables/type') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width="5%"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($photos as $photo): ?>
                                <tr>
                                    <td align="center" valign="middle"><a title="<?php echo $photo->caption; ?>" href="<?php echo $photo->get_image($photo->id, 'larg'); ?>" target="_blank" id="single"><img src="<?php echo $photo->get_image($photo->id, 'small'); ?>" width="50"></a></td>
                                    <td valign="middle"><?php echo $photo->caption; ?></td>
                                    <td align="center"  valign="middle">
                                        <input type="text" value="<?php echo $photo->get_image($photo->id, 'small'); ?>" style="width:250px" /> <a href="<?php echo $photo->get_image($photo->id, 'small'); ?>" id="single"><?php echo show_icon('img_small.png', read_xmls('/site/photos/lables/thumb')) ?></a><br />
                                        <input type="text" value="<?php echo $photo->get_image($photo->id, 'larg'); ?>" style="width:250px" /><a href="<?php echo $photo->get_image($photo->id, 'larg'); ?>" id="single"><?php echo show_icon('img_larg.png', read_xmls('/site/photos/lables/larg')) ?></a></td>
                                    <td align="center" valign="middle"><?php echo $photo->size_as_text(); ?></td>
                                    <td align="center" valign="middle"><?php echo $photo->type; ?></td>
                                    <td align="center" valign="middle"><?php echo show_published($photo->publish); ?></td>
                                    <td align="center" valign="middle"><input type="checkbox" value="<?php echo $photo->id; ?>" name="check[]" title="<?php echo $photo->caption; ?>" <?php
                                        if ((is_array($checked_row) && in_array($photo->id, $checked_row)) || check_var("checked_row", "GET") == $photo->id) {
                                            echo "checked='checked'";
                                        }
                                        ?>/></td>
                                      </tr>
                                      <?php endforeach; ?>
                             </tbody>

                            </table>
                             <table class="button-table" style="float: right;" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                            <?php if ($session->has_permission('PhotoMove')) { ?>
                                <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"/>
                            <?php } ?>
                            <?php if ($session->has_permission('PhotoMove')) { ?>
                                <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  />
                            <?php } ?>
                            <?php if ($session->has_permission('PhotoPublish')) { ?>
                                <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                <input class="btn btn-success" name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                            <?php } ?>
                            <?php if ($session->has_permission('PhotoPublish')) { ?>
                                <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"/>
                            <?php } ?>
                            <?php if ($session->has_permission('PhotoEdit')) { ?>
                                <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"/>
                            <?php } ?>
                            <?php if ($session->has_permission('PhotoDelete')) { ?>
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
<?php } ?>
<?php include_layout_template('admin_footer.php'); ?>
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
