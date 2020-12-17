<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
  redirect_to("../login/");
}
$session->check_permission('LanguageAdd', '_manage.php');
$english_phrases=Language::find_by_field('alias','en');
$english_phrases=$english_phrases[0]->phrases;

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
  $user_admin = User::find_by_id($session->user_id);
  $langs = new Language();
  $langs->title = trim($_POST['title']);
  $langs->alias = trim($_POST['alias']);
  $langs->direction = trim($_POST['direction']);
  $langs->phrases = $english_phrases;
  $langs->publish = 1;

  if ($langs->save_lang()) {
    $session->message(read_xmls('/site/msg/sucuadd'));
    echo log_action("Add New Language: {$langs->title} ", "By: {$user_admin->username}");
    redirect_to("_add.php");
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
        <h2><?php echo read_xmls('/site/lang/titles/add') ?></h2>
        <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/lang/titles/manage') ?>
          <i class="fa fa-edit margin-right-fivePx"></i>
        </a>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <form name="photos" action="_add.php" method="POST" enctype="multipart/form-data">
              <?php echo setToken() ?>
              <div class="form-group">
                <label><?php echo read_xmls('/site/lang/lables/name') ?></label>
                <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" />
              </div>
              <div class="form-group">
                <label><?php echo read_xmls('/site/lang/lables/alias') ?></label>
                <input class="form-control" type="text" name="alias" value="<?php echo check_var("alias", "POST"); ?>" maxlength='50'  onKeyUp="javascript:checkInvalidChars(this);"/>
              </div>
              <div class="form-group">
                <label><?php echo read_xmls('/site/lang/lables/direction') ?></label>
                <select  class="form-control" name="direction">
                  <option value="ltr"><?php echo read_xmls('/site/lang/lables/ltr') ?></option>
                  <option value="rtl"><?php echo read_xmls('/site/lang/lables/rtl') ?></option>
                </select>
              </div>
              <!--
              <div class="form-group">
              <label><?php //echo read_xmls('the_phrases') ?></label>
              <textarea rows="20" dir="ltr" class="form-control" name="phrases" id="phrases"><?php //echo $english_phrases; ?></textarea>
            </div>-->
            <div class="form-group">
              <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="button"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
