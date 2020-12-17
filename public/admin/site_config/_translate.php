<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SiteConfigTranslate', '../');
global $database;
$user_admin = User::find_by_id($session->user_id);
// declare POST or GET checked_row
$checked_row = array();
$Action = new Translator();
// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('SiteConfigTranslate', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_translate_edit.php', FALSE);
}
// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('SiteConfigTranslate', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_translate_delete.php", TRUE);
}

//Find parent category
if (empty($_GET['parent']) || !isset($_GET['parent'])) {
    $session->message(read_xmls('/site/msg/noparent'));
    redirect_to("./_edit.php?id=".$_GET['id']);
} else {
    $parent = SiteConfig::find_by_id($_GET['parent']);
}

// Form Processing
if (isset($_POST['submit'])) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
  
    $lang_id = trim($_POST['lang_id']);
    $title = trim($_POST['title']);
    $offline_msg = trim($_POST['offline_msg']);
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $copyrights = trim($_POST['copyrights']);
    $address = trim($_POST['address']);

    $fields = array('title' => $title, 'offline_msg' => $offline_msg, 'keywords' => $keywords, 'description' => $description, 'copyrights' => $copyrights, 'address' => $address);

    if (!empty($title)) {
        //check lang added
        if (Translator::check_lang($parent->id, $lang_id, SiteConfig::$trans_key) > 0) {
            $session->message(read_xmls('/site/msg/addedbefor'));
            redirect_to("_translate.php?parent={$parent->id}");
        }
        // extract fields and its content then inserting each one on DB
        foreach ($fields as $key => $value):
            $new_translate = Translator::translate($parent->id, $key, $value, SiteConfig::$trans_key, $lang_id);
            if ($new_translate && $new_translate->save()) {
                $session->message(read_xmls('/site/msg/sucuadd'));
            } else {
                //Failed
                $session->message(read_xmls('/site/msg/errorsave'));
            }
        endforeach;
        echo log_action("Add Translate: {$title}", "By: {$user_admin->username}");
        redirect_to("_translate.php?parent={$parent->id}");
    } else {
        $session->message(read_xmls('/site/msg/allrequire'));
        redirect_to("_translate.php?parent={$parent->id}");
    }
} else {
    $title = "";
    $keywords = "";
    $description = "";
    $copyrights = "";
    $address = "";
}
$token_input=setToken();
?>

<?php include_layout_template('admin_header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <center>
                    <a class="btn btn-primary" href="_edit.php?id={$parent->id}"><?php echo read_xmls('/site/siteconfigs/titles/edit') ?>
                       <i class="fa fa-edit margin-right-fivePx"></i>
                    </a>
                </center>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo $token_input ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr >
                                <th><?php echo read_xmls('/site/siteconfigs/lables/title') ?></th>
                                <th><?php echo read_xmls('/site/lang/titles/main') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" title="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $translates = Translator::find_translate_item($parent->id, SiteConfig::$trans_key, 'title');
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
                    <span class="button-table">
                        <?php if ($session->has_permission('SiteConfigTranslate')) { ?>
                           <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                            <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                        <?php } ?>
                        <?php if ($session->has_permission('SiteConfigTranslate')) { ?>
                            <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                            <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                        <?php } ?>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>


  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/siteconfigs/lables/translate') . ": " . $parent->title ?> </h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="?parent=<?php echo $parent->id; ?>" method="post">
                          <?php echo $token_input ?>
                                <div class="form-group">
                                    <td width="243"><?php echo read_xmls('/site/lang/titles/main') ?>: </td>
                                    <td width="511">
                                        <select  class="form-control" name="lang_id">
                                            <?php
                                            //Get all languages except the default lang
                                            $langauges = Language::get_langs_except_default();
                                            foreach ($langauges as $langauge):
                                                echo "<option value='" . $langauge->id . "'>" . $langauge->title . "</option>";
                                            endforeach;
                                            ?>
                                        </select>       </td>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/title') ?></label>
                                    <input type="text" class='form-control' name="title" value="<?php echo $title; ?>" />
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/copyrights') ?></label>
                                    <input type="text" class='form-control' name="copyrights" value="<?php echo @$site_config->copyrights; ?>" maxlength="255"/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/address') ?></label>
                                    <input type="text" class='form-control' name="address" value="<?php echo @$site_config->address; ?>" maxlength="255"/>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/offlinemsg') ?></label>
                                        <?php
                                        $getValue = check_var("offline_msg", "POST");
                                        $getField = 'offline_msg';
                                        $getBaseFolder = '../../aids/ckeditor/';
                                        $getType = '';
                                        include('../../aids/editor.php');
                                        ?>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/keywords') ?></label>
                                    <textarea class='form-control' name="keywords" cols="30" rows="5"><?php echo @$site_config->keywords; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/siteconfigs/lables/description') ?></label>
                                    <textarea class='form-control' name="description" cols="30" rows="5"><?php echo @$site_config->description; ?></textarea>
                                </div>

                                <div class="form-group">
                                        <?php if ($session->has_permission('SiteConfigTranslate')) { ?>
                                            <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="button"/>
                                        <?php } ?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
