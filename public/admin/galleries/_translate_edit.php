<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('GalleryTranslate', '_manage.php');
?>
<?php
if (empty($_GET['id']) || !isset($_GET['id'])) {
    $session->message(read_xmls('/site/msg/noparent'));
    redirect_to("./_manage.php");
}
$cur_trans = Translator::find_by_id($_GET['id']);
$parent = Gallery::find_by_id($cur_trans->parent_id," AND site_id={$session->site_id}");

$user_admin = User::find_by_id($session->user_id);

// Form Processing
if (isset($_POST['submit'])) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $title = trim($_POST['title']);
    $fields = array('title' => $title);

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
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
$trans_title = Translator::find_translate_by_parent_lang_type($cur_trans->parent_id, $cur_trans->item_type, 'title', $cur_trans->lang_id);
?>

<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
            <div  class="panel-heading">
                <h2><?php echo read_xmls('/site/gallery/titles/edit') ?>: <?php echo $trans_title[0]->content; ?></h2>
                    <a class="btn btn-primary pull-left margin-link" href="_add.php"><?php echo read_xmls('/site/gallery/titles/add') ?><i class="fa fa-plus margin-right-fivePx" aria-hidden="true"></i></a>
                    <a class="btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/gallery/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>
                    <a class="btn btn-info pull-left margin-link" href="_translate.php?parent=<?php echo $cur_trans->parent_id; ?>">
                    <?php echo read_xmls('/site/gallery/lables/translate')?><i class="fa fa-language margin-right-fivePx" aria-hidden="true"></i>
                    </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                       <form name="section" action="_translate_edit.php?id=<?php echo $cur_trans->id; ?>" method="POST" enctype="multipart/form-data">
                         <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/gallery/lables/name') ?></label>
                                <input class="form-control"type="text" name="title" value="<?php echo $trans_title[0]->content; ?>" maxlength="255">
                                <?php echo read_xmls('/site/main/lables/charnum') ?>
                            </div>

                            <div class="form-group">
                                  <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="btn btn-primary"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
