<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
  redirect_to("../login/");
}
$session->check_permission('LanguageEditPhrases', '_manage.php');
?>
<?php
if (empty($_GET['id'])) {
  $session->message(read_xmls('/site/msg/selectitem'));
  redirect_to("_manage.php");
}
$lang = Language::find_by_id($_GET['id']);
$user_admin = User::find_by_id($session->user_id);


if (check_var("submit", "POST") || check_var("delete", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
  $del=false;
  if(check_var("delete", "POST")){
    $del=true;
  }

  unset($_POST['_token'],$_POST['submit'],$_POST['delete']);

  $jsonArr=json_decode($lang->phrases,true);

  if($del){
    //delete selected phrases
    foreach ($_POST['to_delete'] as $key => $value) {
      unset($jsonArr[$key]);
    }

  } else {
    foreach ($_POST as $key => $value) {
      $jsonArr[$key]= $value;
    }
  }

  $json = json_encode($jsonArr);
  $updateJson=  Language::update_by_field('phrases',$json," WHERE alias = '".$lang->alias."'");
  if($updateJson){
    $session->message(read_xmls('/site/msg/sucupdate'));
    echo log_action("Update Language Phrases: {$lang->title} ", "By: {$user_admin->username}");
    redirect_to("_edit_phrases.php?id=" . $lang->id);
  } else {
    $session->message(read_xmls('can_not_update_phrases'));
    redirect_to("_edit_phrases.php?id=" . $lang->id);
  }

}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2><?php echo read_xmls('edit_phrases') ?>: <?php echo $lang->title; ?></h2>
        <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/lang/titles/manage') ?>
          <i class="fa fa-edit margin-right-fivePx"></i>
        </a>
      </div>
      <div class="panel-body">


        <form name="lang" action="_edit_phrases.php?id=<?php echo $lang->id; ?>" method="POST" enctype="multipart/form-data">
          <div class="row">
            <?php echo setToken() ?>
            <?php
            $phrases=json_decode($lang->phrases,true);
            foreach($phrases as $key=>$value):?>
            <div class="col-md-4">
              <fieldset class="form-group">
                <pre><span><input type="checkbox" name="to_delete[<?php echo $key?>]" value="<?php echo $value?>"></span> <label for="<?php echo $key?>"><?php echo $key?></label></pre> <br>
                <div class="form-control" id="div_<?php echo $key?>" onclick="$('#<?php echo $key?>').removeAttr('disabled');$('#<?php echo $key?>').show();$('#'+this.id).hide(); "><?php echo $value?></div>
                <input style="display:none;" type="text" class="form-control" name="<?php echo $key?>" id="<?php echo $key?>" required="true" value="<?php echo $value?>" disabled="">
              </fieldset>
            </div>
          <?php endforeach;?>
        </div>
        <div class="row" align="center" >
          <div class="form-group">
            <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"/>
            <input class="btn btn-danger" type="submit" name="delete" value="<?php echo read_xmls('delete_checked_items') ?>" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');"/>
          </div>
        </form>


      </div>

    </div>
  </div>
</div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
