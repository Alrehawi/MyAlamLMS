<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('AdSectionAdd', '_manage.php');

if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
}

if (check_var("submit", "POST")) {
    $user_admin = User::find_by_id($session->user_id);
    // assign new sort id
    $adsections = new AdSection();
    $adsections->title = trim($_POST['title']);
    // get default lang ID
    $default_lang = Language::get_default_lang();
    $adsections->lang_id = $default_lang[0]->id;
    $adsections->site_id = $session->site_id;

    $adsections->publish = 1;
    $adsections->created = current_date();
    // get default lang ID

    if ($adsections->save_adsection()) {
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New AdSection: {$adsections->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $adsections->errors);
    }
} else {

}
?>
<?php include_layout_template('admin_header.php'); ?>
<?php echo output_message($message); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default" style="border: none;">
            <div  class="panel-heading">
                    <h2><?php echo read_xmls('/site/adsec/titles/add') ?></h2>
                   <?php if ($session->has_permission('AdSectionView')) { ?>
                        <a class="btn btn-primary pull-left margin-link" href="_manage.php"><?php echo read_xmls('/site/adsec/titles/manage') ?><i class="fa fa-plus margin-right-fivePx" aria-hidden="true"></i></a>
                    <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                      <form name="adsection" action="_add.php" method="POST" enctype="multipart/form-data">
                        <?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/adsec/lables/name') ?></label>
                                <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255" />
                            </div>
                            <div class="form-group">
                                  <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="btn btn-primary"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_layout_template('admin_footer.php'); ?>
