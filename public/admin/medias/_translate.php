<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MediaTranslate', '../');
global $database;
$user_admin = User::find_by_id($session->user_id);
// declare POST or GET checked_row
$checked_row = array();
$Action = new Translator();
// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('MediaTranslate', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_translate_edit.php', FALSE);
}
// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('MediaTranslate', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_translate_delete.php", TRUE);
}

//Find parent ad
if (empty($_GET['parent']) || !isset($_GET['parent'])) {
    $session->message(read_xmls('/site/msg/noparent'));
    redirect_to("./_manage.php");
} else {
    $parent = Media::find_by_id($_GET['parent']);
}

// Form Processing
if (isset($_POST['submit'])) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
    $lang_id = trim($_POST['lang_id']);
    $title = trim($_POST['title']);
    $fields = array('title' => $title);

    if (!empty($title)) {
        //check lang added
        if (Translator::check_lang($parent->id, $lang_id, Media::$trans_key) > 0) {
            $session->message(read_xmls('/site/msg/addedbefor'));
            redirect_to("_translate.php?parent={$parent->id}");
        }
        // extract fields and its content then inserting each one on DB
        foreach ($fields as $key => $value):
            $new_translate = Translator::translate($parent->id, $key, $value, Media::$trans_key, $lang_id);
            if ($new_translate && $new_translate->save()) {
                $session->message(read_xmls('/site/msg/sucuadd'));
            } else {
                //Failed
                $session->message(read_xmls('/site/msg/errorsave'));
            }
        endforeach;
        echo log_action("Mediad Translate: {$title}", "By: {$user_admin->username}");
        redirect_to("_translate.php?parent={$parent->id}");
    } else {
        $session->message(read_xmls('/site/msg/allrequire'));
        redirect_to("_translate.php?parent={$parent->id}");
    }
} else {
    $title = "";
}

$token_input=setToken();
?>

<?php include_layout_template('admin_header.php'); ?>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 <?php if ($session->has_permission('MediaAdd')) { ?>
                    <a class=" btn btn-primary"  href="_add.php?gallery_id=<?php echo $parent->gallery_id ?>"><?php echo read_xmls('/site/media/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
                <?php if ($session->has_permission('MediaView')) { ?>
                    <a class=" btn btn-primary"  href="_manage.php?gallery_id=<?php echo $parent->gallery_id ?>"><?php echo read_xmls('/site/media/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>
                <?php } ?>
                <?php if ($session->has_permission('MediaEdit')) { ?>
                    <a class=" btn btn-primary"  href="_edit.php?id=<?php echo $parent->id; ?>"><?php echo read_xmls('/site/adminactions/edit') ?><i class="fa fa-edit margin-right-fivePx" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo $token_input ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr>
                                <th><?php echo read_xmls('/site/media/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/lang/titles/main') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                               <?php
                            $translates = Translator::find_translate_item($parent->id, Media::$trans_key, 'title');
                            foreach ($translates as $translate):
                                $get_title = Language::find_by_id($translate->lang_id);
                                ?>
                                <tr>
                                    <td><?php echo $translate->content; ?></td>
                                    <td><?php echo $get_title->title; ?></td>
                                    <td width='80' align="center">
                                        <input type="checkbox" value="<?php echo $translate->id; ?>" name="check[]" title="<?php echo $translate->content; ?>" <?php
                                        if ((is_array($checked_row) && in_array($translate->id, $checked_row)) || check_var("checked_row", "GET") == $translate->id) {
                                            echo "checked='checked'";
                                        }
                                        ?>/>
                                        <input type="hidden" name="item_lang" value="<?php echo $translate->lang_id ?>" />
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                       <span class="button-table"><label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                            <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                            <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                            <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                        </span>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
               <center><h2><?php echo read_xmls('/site/media/lables/translate') . ": " . $parent->title ?> </h2></center>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form"  action="?parent=<?php echo $parent->id; ?>" method="post">
                          <?php echo $token_input ?>
                           <div class="form-group">
                                <label><?php echo read_xmls('/site/media/lables/name') ?></label>
                                <input required class="form-control" type="text" name="title" value="<?php echo $title; ?>">
                            </div>

                            <div class="form-group">
                                <label><?php echo read_xmls('/site/lang/titles/main') ?></label>
                                <select  class="form-control" name="lang_id">
                                    <?php
                                    //Get all languages except the default lang
                                    $langauges = Language::get_langs_except_default();
                                    foreach ($langauges as $langauge):
                                        echo "<option value='" . $langauge->id . "'>" . $langauge->title . "</option>";
                                    endforeach;
                                    ?>
                                </select>
                                <div class="form-group">
                                    <input class="btn btn-primary" style="margin-top: 10px" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>" />
                               </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
