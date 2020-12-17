<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MediaView', '../');
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
$Action = new Media();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('MediaEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('MediaTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('MediaDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('MediaPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('MediaPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Move Up
if (check_var("sort_up", "POST") && check_var("gallery_id", "POST") && check_var("check", "POST") && $session->check_permission('MediaMove', '_manage.php')) {
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, " AND gallery_id=" . $_POST['gallery_id'] . " ");
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("gallery_id", "POST") && check_var("check", "POST") && $session->check_permission('MediaMove', '_manage.php')) {
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE, " AND gallery_id=" . $_POST['gallery_id'] . " ");
}
?>


<form name="assign" action="<?php echo get_current_page(); ?>" method="POST">
    <?php echo read_xmls('/site/gallery/lables/name'); ?>:
    <select  class="form-control" name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'gallery_id', ''); ?>')">
        <option value=""><?php echo read_xmls('/site/gallery/lables/name'); ?></option>
        <?php
        $get_categories = Gallery::find_all("title ASC","WHERE site_id={$session->site_id}");
        foreach ($get_categories as $gallery) {
            ?>
            <option value="<?php echo $gallery->id ?>"<?php
            if (check_var('gallery_id', 'GET') == $gallery->id) {
                echo ' selected';
            }
            ?>><?php echo $gallery->title ?>(<?php echo Media::count_all("WHERE gallery_id=" . $gallery->id) ?>)</option>
<?php } ?>
    </select>
</form>
<br />
<?php
if (isset($_GET['gallery_id']) && !empty($_GET['gallery_id'])) {
    $gallery_id = intval($_GET['gallery_id']);
// start pagination
    $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
    if (SiteConfig::site_config('paging'))
        $per_page = SiteConfig::site_config('paging');
    else
        $per_page = 20;
    $total_count = Media::count_all("WHERE gallery_id=" . $database->escape_value($gallery_id) . " AND (" . Media::search(@$_GET['s'], array('title')) . ") ");
    $pagination = new Pagination($page, $per_page, $total_count);

    $sql = "SELECT * FROM medias where gallery_id=" . $gallery_id . " ";
    if (!empty($_GET['s'])) {
        $sql .= "AND (" . Media::search(@$_GET['s'], array('title')) . ") ";
    }
    $sql .= "ORDER BY sort_id ASC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $medias = Media::find_by_sql($sql);
    ?>
    <?php
    $hidden_input = "<input type='hidden' name='gallery_id' value='" . @$gallery_id . "' />";
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
                <h2><?php echo read_xmls('/site/media/titles/manage') ?></h2>
                <?php if ($session->has_permission('MediaAdd')) { ?>
                    <a style="color: #fff;"  class="pull-left btn btn-primary" href="_add.php?gallery_id=<?php echo @$_GET['gallery_id'] ?>"><?php echo read_xmls('/site/media/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
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
                                <th><?php echo read_xmls('/site/media/lables/thumb') ?></th>
                                <th><?php echo read_xmls('/site/media/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/media/lables/type') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                foreach ($medias as $media):
                                    ?>
                                    <tr>
                                        <td align="center" valign="middle">
                                            <?php
                                            if ($media->media_type == 'image') {
                                                ?>
                                                <a title="<?php echo $media->title; ?>" href="<?php echo $media->get_image($media->id, 'larg', $media->gallery_id); ?>" id="single"><img src="<?php echo $media->get_image($media->id, 'small', $media->gallery_id); ?>" width="50" /></a>
                                                <?php
                                            } else if ($media->media_type == 'youtube') {
                                                $youtubeparam = doubleExplode('v=', '&', $media->url);
                                                @$youtubeparam = array_shift(array_values($youtubeparam));
                                                ?>
                                                <a title="<?php echo $media->title; ?>" id="single" class="various iframe" href="https://www.youtube.com/embed/<?php echo @$youtubeparam; ?>?autoplay=1"><img src="https://i2.ytimg.com/vi/<?php echo $youtubeparam; ?>/mqdefault.jpg" width="50" /></a>
                                            <?php
                                            } else if ($media->media_type == 'video' || $media->media_type == 'audio') {
                                            ?>
                                                <a title="<?php echo $media->title; ?>" href="../../player.php?path=<?php echo File::get_file($media->file_id)?>&type=<?php echo $media->media_type;?>" id="single"><img src="<?php echo show_icon('player.png','','back_images',false); ?>" width="50"/></a>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo Media::find_viewed_language('title', intval($media->id), Media::$trans_key) ?></td>
                                        <td align="center">
                                            <?php
                                            if ($media->media_type == 'image') {
                                                echo show_icon('image.png', read_xmls('/site/media/lables/image'));
                                            } else if ($media->media_type == 'youtube') {
                                                $youtubeparam = doubleExplode('v=', '&', $media->url);
                                                @$youtubeparam = array_shift(array_values($youtubeparam));
                                                echo show_icon('youtube.png', read_xmls('/site/media/lables/youtube'));
                                            } else if($media->media_type == 'video') {
                                                echo show_icon('video.png','');
                                            } else if($media->media_type == 'audio') {
                                                echo show_icon('audio.png','');
                                            }
                                            //echo "<br />".$media->sort_id;
                                            ?>
                                        </td>
                                        <td align="center"><?php echo show_published($media->publish); ?></td>
                                        <td align="center"><input type="checkbox" value="<?php echo $media->id; ?>" name="check[]" title="<?php echo $media->title; ?>" <?php
                                                          if ((is_array($checked_row) && in_array($media->id, $checked_row)) || check_var("checked_row", "GET") == $media->id) {
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
                                    <?php if ($session->has_permission('MediaMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MediaMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  />
                                    <?php } ?>
                                    <?php if ($session->has_permission('MediaPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                        <input class="btn btn-success" name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MediaPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MediaTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                        <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MediaEdit')) { ?>
                                        <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('MediaDelete')) { ?>
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
