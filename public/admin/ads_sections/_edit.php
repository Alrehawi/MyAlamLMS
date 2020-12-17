<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('AdSectionEdit', '_manage.php');




if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}
$adsection = AdSection::find_by_id($_GET['id']," AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if (check_var("submit", "POST")) {

  if(!checkToken($_POST['_token'])){
      $session->message(read_xmls('/site/msg/invalidsubmit'));
      redirect_to("_manage.php");
  }

    $adsections = new AdSection();
    $adsections->id = $_GET['id'];
    $adsections->title = trim($_POST['title']);
    $adsections->lang_id = $adsection->lang_id;
    $adsections->site_id = $adsection->site_id;
    $adsections->publish = $adsection->publish;
    $adsections->created = $adsection->created;
    $adsections->updated = current_date();

    if ($adsections->save_adsection($adsection->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update AdSection: {$adsections->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $adsection->id);
    } else {
        $message = join("<br/>", $adsections->errors);
    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
            <div  class="panel-heading">
                <h2><?php echo read_xmls('/site/adsec/titles/edit') ?>: <?php echo $adsection->title; ?></h2>
                <a class=" btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/adsec/titles/manage') ?><i class="fa fa-th-list margin-right-fivePx" aria-hidden="true"></i></a>
                <?php if ($session->has_permission('AdSectionTranslate')) { ?>
                    <a class=" btn btn-info pull-left margin-link" href="_translate.php?parent=<?php echo $adsection->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?><i class="fa fa-language margin-right-fivePx" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                       <form name="adsection" action="_edit.php?id=<?php echo $adsection->id; ?>" method="POST" enctype="multipart/form-data">
                         <?php echo setToken() ?>
                                <div class="form-group">
                                    <label><?php echo read_xmls('/site/adsec/lables/name') ?></label>
                                    <input class="form-control" type="text" name="title" value="<?php echo $adsection->title; ?>" maxlength="255">
                                        <?php echo read_xmls('/site/main/lables/charnum') ?></label>
                                </div>
                                <div class="form-group">
                                  <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>" class="btn btn-primary" />
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
