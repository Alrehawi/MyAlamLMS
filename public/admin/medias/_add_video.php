<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MediaAdd', '_manage.php');
if (!isset($_GET['gallery_id']) || !Gallery::count_by_field('id', $_GET['gallery_id'])) {
    $session->message(read_xmls('/site/gallery/msg/detrmingallery'));
    redirect_to("../galleries/_manage.php");
} else {
    $gallery_id = intval($_GET['gallery_id']);
    $gallery = Gallery::find_by_id($gallery_id,"and site_id={$session->site_id}");
}
?>

                        <a class="pull-left" href="">&raquo;&raquo; <?php echo read_xmls('/site/adminactions/back') ?></a> 
                        <div class="form-group">
                            <label><?php echo read_xmls('/site/media/lables/name') ?></label>
                            <input class="form-control" type="text" name="title" maxlength="255" />
                            <?php echo read_xmls('/site/media/lables/charnum') ?>
                        </div>
                         <div class="form-group">
                            <label><?php echo read_xmls('/site/gallery/lables/name') ?></label>
                            <select  class="form-control" name="gallery_id">
                                <?php
                                //Get all Galleries
                                $gallerys = Gallery::find_all("title ASC","WHERE site_id={$session->site_id}");
                                foreach ($gallerys as $gallery):
                                    ?>
                                    <option value='<?php echo $gallery->id; ?>'<?php if ($gallery->id == $gallery_id) echo ' selected' ?>><?php echo $gallery->title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                         <div class="form-group">
                            <label><?php echo read_xmls('/site/media/lables/link') ?></label>
                            <input class="form-control" type="text" name="url" value="http://" maxlength="100">
                        </div>
                         <div class="form-group">
                            <label><?php echo read_xmls('/site/media/lables/width') ?></label>
                            <input type="text" name="width" maxlength="3" onkeypress='return isNumberKey(event)' style="width:30%">
                            x
                            <input type="text" name="height" maxlength="3" onkeypress='return isNumberKey(event)' style="width:30%">
                            <label>[PX] <?php echo read_xmls('/site/media/lables/height') ?></label>
                        </div>

                        <div class="form-group">
                           <input type="hidden" name="media_type" value="youtube" />
                           <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="btn btn-primary"/>
                        </div>
                  