<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SiteConfigTranslate', '_manage.php');
?>
<?php
if (empty($_GET['id']) || !isset($_GET['id'])) {
    $session->message(read_xmls('/site/msg/noparent'));
    redirect_to("./_edit.php?id=".$_GET['id']);
}
$cur_trans = Translator::find_by_id($_GET['id']);
$parent = SiteConfig::find_by_id($cur_trans->parent_id);

$user_admin = User::find_by_id($session->user_id);

// Form Processing
if (isset($_POST['submit'])) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
  
    $title = trim($_POST['title']);
    $offline_msg = trim($_POST['offline_msg']);
    $keywords = trim($_POST['keywords']);
    $description = trim($_POST['description']);
    $copyrights = trim($_POST['copyrights']);
    $address = trim($_POST['address']);

    $fields = array('title' => $title, 'offline_msg' => $offline_msg, 'keywords' => $keywords, 'description' => $description, 'copyrights' => $copyrights, 'address' => $address);

    if (!empty($title)) {
        // extract fields and its content then inserting each one on DB
        foreach ($fields as $key => $value):
            $translate_in = new Translator();
            $translate = Translator::find_translate_by_parent_lang_type($cur_trans->parent_id, $cur_trans->item_type, $key, $cur_trans->lang_id);
            $translate_in->id = $translate[0]->id;
            $translate_in->parent_id = $translate[0]->parent_id;
            $translate_in->item_type = $translate[0]->item_type;
            $translate_in->field_type = $key;
            $translate_in->content = $value;
            $translate_in->created = $translate[0]->created;
            $translate_in->updated = current_date();
            $translate_in->lang_id = $translate[0]->lang_id;

            if ($translate_in->save($translate[0]->id)) {
                $session->message(read_xmls('/site/msg/sucupdate'));
            } else {
                //Failed
                $session->message(read_xmls('/site/msg/errorsave'));
            }
        endforeach;
        redirect_to("_translate_edit.php?id={$cur_trans->id}");
    } else {
        $session->message(read_xmls('/site/msg/allrequire'));
        redirect_to("_translate_edit.php?id={$cur_trans->id}");
    }
} else {
    $title = "";
    $keywords = "";
    $description = "";
    $copyrights = "";
    $address = "";
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
$translate_title = Translator::find_translate_by_parent_lang_type($cur_trans->parent_id, $cur_trans->item_type, 'title', $cur_trans->lang_id);
$translate_offline_msg = Translator::find_translate_by_parent_lang_type($cur_trans->parent_id, $cur_trans->item_type, 'offline_msg', $cur_trans->lang_id);
$translate_keywords = Translator::find_translate_by_parent_lang_type($cur_trans->parent_id, $cur_trans->item_type, 'keywords', $cur_trans->lang_id);
$translate_description = Translator::find_translate_by_parent_lang_type($cur_trans->parent_id, $cur_trans->item_type, 'description', $cur_trans->lang_id);
$translate_copyrights = Translator::find_translate_by_parent_lang_type($cur_trans->parent_id, $cur_trans->item_type, 'copyrights', $cur_trans->lang_id);
$translate_address = Translator::find_translate_by_parent_lang_type($cur_trans->parent_id, $cur_trans->item_type, 'address', $cur_trans->lang_id);
?>
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/siteconfigs/lables/translate') ?>: <?php echo $translate_title[0]->content; ?></h2>

                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/siteconfigs/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="category" action="_translate_edit.php?id=<?php echo $cur_trans->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/siteconfigs/lables/title') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo $translate_title[0]->content; ?>" maxlength="255" />
                            </div>
                            <div class="form-group">
                                <td><?php echo read_xmls('/site/siteconfigs/lables/copyrights') ?></label>
                                <input class="form-control" type="text" name="copyrights" value="<?php echo $translate_copyrights[0]->content; ?>" maxlength="255"/>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/siteconfigs/lables/address') ?></label>
                                <input class="form-control" type="text" name="address" value="<?php echo $translate_address[0]->content; ?>" maxlength="255"/>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/siteconfigs/lables/offlinemsg') ?></label>
                                <?php
                                    $getValue = $translate_offline_msg[0]->content;
                                    $getField = 'offline_msg';
                                    $getBaseFolder = '../../aids/ckeditor/';
                                    $getType = '';
                                    include('../../aids/editor.php');
                                    ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/siteconfigs/lables/keywords') ?></label>
                                <textarea class="form-control" name="keywords" cols="30" rows="5"><?php echo $translate_keywords[0]->content; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/siteconfigs/lables/description') ?></label>
                                <textarea class="form-control" name="description" cols="30" rows="5"><?php echo $translate_description[0]->content; ?></textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
