<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('PartAdd', '_manage.php');
$page_id = @intval($_GET['page_id']);
?>
<?php
if (check_var("submit", "POST")) {
    // assign new sort id
    $new_sort_id = Part::count_new_sort_id("WHERE page_id=" . @intval($_POST['page_id']));

    $user_admin = User::find_by_id($session->user_id);
    @$parts = new Part();
    @$parts->title = trim($_POST['title']);
    @$parts->page_id = $_POST['page_id'];
    @$parts->show_title = $_POST['show_title'];
    @$parts->content = trim($_POST['content']);
    @$parts->sort_id = $new_sort_id;
    @$parts->publish = 1;
    @$parts->created = current_date();
    // get default lang ID
    $default_lang = Language::get_default_lang();
    $parts->lang_id = $default_lang[0]->id;

    if ($parts->save_part()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Part: {$parts->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
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
                <h2><?php echo read_xmls('/site/part/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/part/titles/manage') ?><i class="fa fa-plus"></i></a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_add.php?page_id=<?php echo @$page_id ?>" method="POST" enctype="multipart/form-data">                                       
                            <div class="form-group">
                               <label width="12%"><?php echo read_xmls('/site/part/lables/name') ?> </label>
                               <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255">
                              <?php echo read_xmls('/site/part/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/part/lables/page') ?></label>
                                <select  class="form-control" name="page_id">
                                    <?php
                                    //Get all Pages
                                    $pages = Page::find_all("title ASC","WHERE site_id={$session->site_id}");
                                    foreach ($pages as $page):
                                        ?>
                                        <option value='<?php echo $page->id; ?>'<?php
                                        if (@$_POST['page_id'] == $page->id || $page->id == @$page_id) {
                                            echo ' selected';
                                        }
                                        ?>><?php echo Page::find_viewed_language('title', $page->id, Page::$trans_key); ?></option>
                                            <?php endforeach; ?>            
                                </select>       
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/part/lables/showtitle') ?></label>
                                <input type="checkbox" name="show_title" value="1" <?php
                                    if (check_var("show_title", "POST") == 1) {
                                        echo ' checked';
                                    }
                                    ?>/>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/part/lables/content') ?></label>
                                <?php
                                $getValue = check_var("content", "POST");
                                $getField = 'content';
                                $getBaseFolder = '../../aids/ckeditor/';
                                $getType = 'larg';
                                include('../../aids/editor.php');
                                ?>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="button"/>
                            </div>
                            <div class="form-group">

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>