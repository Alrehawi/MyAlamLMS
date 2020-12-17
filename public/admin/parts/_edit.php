<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PartEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$part = Part::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
    $parts = new Part();
    $parts->id = $_GET['id'];
    @$parts->title = trim($_POST['title']);
    @$parts->page_id = $_POST['page_id'];
    @$parts->show_title = $_POST['show_title'];
    @$parts->content = trim($_POST['content']);
    $parts->lang_id = $part->lang_id;
    $parts->sort_id = $part->sort_id;
    $parts->publish = $part->publish;
    $parts->created = $part->created;
    $parts->updated = current_date();

    if ($parts->save_part($part->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Part: {$parts->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $part->id);
    } else {
        $message = join("<br/>", $parts->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

  <!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
               <h2><?php echo read_xmls('/site/part/titles/edit') ?>: <?php echo $part->title; ?></h2>
                <a class="btn btn-primary pull-left margin-link" href="_manage.php?photo_sec=admin"><?php echo read_xmls('/site/photos/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx"></i></a>
                <?php if ($session->has_permission('PartTranslate')) { ?>
                    <a class="btn btn-info pull-left" href="_translate.php?parent=<?php echo $part->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?><i class="fa fa-language margin-right-fivePx"></i> </a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="part" action="_edit.php?id=<?php echo $part->id; ?>" method="POST" enctype="multipart/form-data">
                           
                        <!--    <p>Select File: <input type="file" name="file_upload"></p>-->
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/part/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo $part->title; ?>" maxlength="255" />
                            </div>


                            <div class="form-group">
                             <label><?php echo read_xmls('/site/part/lables/page') ?></label>
                                <select  class="form-control" name="page_id">
                                        <?php
                                        //Get all Pages
                                        $pages = Page::find_all("title ASC","WHERE site_id={$session->site_id}");
                                        foreach ($pages as $page):
                                            ?>
                                            <option value='<?php echo $page->id; ?>'<?php if ($part->page_id == $page->id) {
                                            echo ' selected';
                                        } ?>><?php echo Page::find_viewed_language('title', $page->id, Page::$trans_key) ?></option>
                                        <?php endforeach; ?>
                                    </select>                      
                             </div>
                           <div>
                                <label><?php echo read_xmls('/site/part/lables/content') ?></label>
                                <?php
                                $getValue = $part->content;
                                $getField = 'content';
                                $getBaseFolder = '../../aids/ckeditor/';
                                $getType = 'larg';
                                include('../../aids/editor.php');
                                ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/part/lables/showtitle') ?></label>
                                <input type="checkbox" name="show_title" value="1" <?php if ($part->show_title == 1) {
                                echo ' checked';
                                  } ?>/>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>