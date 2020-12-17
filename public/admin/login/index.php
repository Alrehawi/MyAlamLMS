<?php
require_once("../../../includes/initialize.php");

if ($session->is_logged_in()) {
    redirect_to("../");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  if(!checkToken($_POST['_token'])){
  $session->message(read_xmls('/site/msg/invalidsubmit'));
  redirect_to("./");
}


    $username = trim($_POST['username']);
    $password = trim(encrept($_POST['password']));
   //$password = trim($_POST['password']);

    // Check database to see if username/password exist.
    $found_user = User::authenticate($username, $password);

    if($found_user) {
      $session->login($found_user);
      log_action('Login', " {$found_user->username} Logged In ..!");
      //$found_user->resetLoginAttemps($found_user->id);
      //check for role and its permissions and assgin permission sessions
      $all_perms = Per2role::perms_per_role($found_user->role_id);
      $session->register_perms($all_perms);
      $role = Role::find_by_id($found_user->role_id);
      $session->site_id($role->site_id);
      //echo isset($_SESSION['LanguageAdd'])? $_SESSION['LanguageAdd'] : false;

      redirect_to("./");

  }

} else { // Form has not been submitted.
    $username = "";
    $password = "";
}
?>
<?php include_layout_template('admin_header.php'); ?>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 login-panel">
              <center>
                <div class="login_logo">
                  <img src="<?php echo Photographs::get_image(SiteConfig::site_config('logo_path'), 'larg'); ?>"  title="<?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key) ?>" alt="<?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key) ?>" width="100">
                </div>
                <p><?php echo SiteConfig::find_viewed_language('title', $session->site_id, SiteConfig::$trans_key);?></p>

              </center>
                <div class=" panel panel-default">

                    <div class="panel-heading">
                      <center>

                        <h3 class="panel-title">
                            <?php echo read_xmls('/site/adminlogin/lables/login') ?>
                        </h3>
                        </center>
                    </div>
                    <div class="panel-body">
                        <form role="form"  action="./" method="post">
                          <?php echo setToken();?>
                            <fieldset>
                              <div><?php echo isset($message) ? output_message($message) : false; ?></div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="<?php echo read_xmls('/site/users/lables/username') ?>" value="<?php echo htmlentities($username); ?>" name="username" type="text"  maxlength="30" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="<?php echo read_xmls('/site/users/lables/password') ?>" name="password" type="password" autocomplete="off" maxlength="30">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button name="submit" type="submit" class="btn btn-lg btn-primary btn-block">
                                    <?php echo read_xmls('/site/adminactions/login') ?>
                                </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
// footer
include_layout_template('admin_footer.php');
?>
