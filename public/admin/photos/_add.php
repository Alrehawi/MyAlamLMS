<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PhotoAdd', '_manage.php?photo_sec=admin');

include_layout_template('admin_header.php');
echo get_js('upload_multi' . DS . 'jquery.min.js');
echo get_js('upload_multi' . DS . 'bootstrap.min.js');
echo get_js('upload_multi' . DS . 'jquery.form.js');
echo get_js('upload_multi' . DS . 'upload.js');
$max_file_size = "1000000";
?>

  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/photos/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php?photo_sec=admin"><?php echo read_xmls('/site/photos/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" name="photos" id="photos" enctype="multipart/form-data" action="_upload.php">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                 <label><?php echo read_xmls('/site/photos/lables/selectfile') ?></label>
                                 <input class="form-control" type="file" name="file_upload[]" id="image_file" multiple >
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/photos/lables/thumbwidth') ?></label>
                                <input type="text" name="thumb_width" value="<?php if (@$_POST['thumb_width'])
                                    echo $_POST['thumb_width'];
                                else
                                    echo 100;
                                ?>" maxlength="4" onkeypress='return isNumberKey(event)' style="width:30%"/>
                                X
                                <input type="text" name="thumb_height" value="<?php if (@$_POST['thumb_height'])
                                    echo $_POST['thumb_height'];
                                else
                                    echo 100;
                                ?>" maxlength="4" onkeypress='return isNumberKey(event)' style="width:30%"/>      <label><?php echo read_xmls('/site/photos/lables/thumbheight') ?></label>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/photos/lables/imagewidth') ?></label>
                                <input type="text" name="image_width" value="<?php if (@$_POST['image_width'])
                                           echo $_POST['image_width'];
                                       else
                                           echo 1024;
                                ?>" maxlength="4" onkeypress='return isNumberKey(event)' style="width:30%"/>
                                X
                                <input type="text" name="image_height" value="<?php if (@$_POST['image_height'])
                                           echo $_POST['image_height'];
                                       else
                                           echo 1600;
                                ?>" maxlength="4" onkeypress='return isNumberKey(event)' style="width:30%"/>      <label><?php echo read_xmls('/site/photos/lables/imageheight') ?></label>
                            </div>
                            <div class="form-group">
                                <div class="file_uploading" id="hidden">
                                  <?php echo show_icon('loading.gif', read_xmls('/site/adminactions/uploading'),'images'); ?>
                                  </div>
                                  <div id="uploaded_images_preview"></div>
                                  <!-- <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/upload') ?>" class="button" /> -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
