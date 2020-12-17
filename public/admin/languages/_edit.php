<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
  redirect_to("../login/");
}
$session->check_permission('LanguageEdit', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
  $session->message(read_xmls('/site/msg/selectitem'));
  redirect_to("_manage.php");
}
$lang = Language::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
  $langs = new Language();
  $langs->id = $_GET['id'];
  $langs->title = trim($_POST['title']);
  $langs->alias = $lang->alias;
  $langs->direction = trim($_POST['direction']);
  $langs->publish = $lang->publish;
  $langs->defaults = $lang->defaults;
  $langs->font = trim($_POST['font']);
  $langs->phrases = $lang->phrases;

  if ($langs->save_lang($lang->id)) {
    $session->message(read_xmls('/site/msg/sucupdate'));
    echo log_action("Update Language: {$langs->title} ", "By: {$user_admin->username}");
    redirect_to("_edit.php?id=" . $lang->id);
  } else {
    $message = join("<br/>", $langs->errors);
  }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2><?php echo read_xmls('/site/lang/titles/edit') ?>: <?php echo $lang->title; ?></h2>
        <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/lang/titles/manage') ?>
          <i class="fa fa-edit margin-right-fivePx"></i>
        </a>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <form name="lang" action="_edit.php?id=<?php echo $lang->id; ?>" method="POST" enctype="multipart/form-data">
              <?php echo setToken() ?>
              <div class="form-group">
                <label><?php echo read_xmls('/site/lang/lables/name') ?></label>
                <input class="form-control" type="text" name="title" value="<?php echo $lang->title; ?>">
              </div>
              <div class="form-group">
                <label><?php echo read_xmls('/site/lang/lables/alias') ?></label>
                <label><?php echo $lang->alias; ?></label>
                </div>
                <div class="form-group">
                  <label><?php echo read_xmls('font_type') ?></label>
                  <input class="form-control" type="text" name="font" value="<?php echo $lang->font; ?>">
                  </div>
                <div class="form-group">
                  <label><?php echo read_xmls('/site/lang/lables/direction') ?></label>
                  <select  class="form-control" name="direction">
                    <option value="ltr" <?php if ($lang->direction == 'ltr') {
                      echo ' selected';
                    } ?>><?php echo read_xmls('/site/lang/lables/ltr') ?></option>
                    <option value="rtl" <?php if ($lang->direction == 'rtl') {
                      echo ' selected';
                    } ?>><?php echo read_xmls('/site/lang/lables/rtl') ?></option>
                  </select>
                </div>
                <!--
                <div class="form-group">
                <label><?php //echo read_xmls('phrases') ?></label>
                <textarea rows="20" class="form-control" dir="ltr" name="phrases" id="phrases"><?php //echo $lang->phrases; ?></textarea>
              </div>-->
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
