<?php
global $session, $page_title, $hide_title;
if (isset($_POST['submit'])) {
    echo include_action_file('contacts.php');
}
?>
<script type="text/javascript">
    function validate() {
        with (contact) {
            if (document.contact.email.value != '' && validate_email(email, "<?php echo read_xmls('/site/frontend/msg/validemail') ?>") == false) {
                document.contact.email.focus();
                return false;
            }
        }
    }
</script>

<!-- Contact Form Section START -->
<div class="section-block">
  <div class="container">
    <div class="section-heading center-holder">
      <!-- <span>Get in Touch</span> -->
      <h3><?php echo read_xmls('contact_us')?></h3>
      <div class="section-heading-line"></div>
    </div>
    <div class="mt-50">
      <div class="contact-form-box">
        <!-- Form Start -->

        <form name="contact" id="contactus" action="" method="POST" enctype="multipart/form-data"  class="contact-form row">
          <?php echo setToken() ?>
          <div class="col-md-6 col-sm-6 col-12">
            <input placeholder="<?php echo read_xmls('/site/frontend/contact/lables/name') ?>" class="form-control" type="text" required required name="name" value="<?php echo @$_POST['name'] ?>"/>
          </div>
          <div class="col-md-6 col-sm-6 col-12">

            <input placeholder="<?php echo read_xmls('/site/frontend/contact/lables/email') ?>" class="form-control" type="email" required  name="email" value="<?php echo @$_POST['email'] ?>"/>
          </div>
          <div class="col-md-12">
            <input placeholder="<?php echo read_xmls('/site/frontend/contact/lables/phone') ?>" class="form-control"type="number" required name="phone" value="<?php echo @$_POST['phone'] ?>"  onkeypress='return isNumberKey(event)' maxlength="15"/>
          </div>
          <div class="col-md-12">
            <textarea placeholder="<?php echo read_xmls('/site/frontend/contact/lables/msg') ?>" name="msg" required id='message' ><?php echo @$_POST['msg'] ?></textarea>
          </div>
          <div class="col-md-9 col-sm-9 col-12">
            <input placeholder="<?php echo read_xmls('/site/frontend/contact/lables/captcha') ?>" class="form-control"type="number" name="captcha" required id="scaptcha" value="<?php echo @$_POST['captcha'] ?>"/>
          </div>
          <div class="col-md-3 col-sm-3 col-12">

            <img src="aids/captcha.php" class="captch">
          </div>
          <div class="col-md-9 col-sm-9 col-12">
            <label>&nbsp;</label>
            <input type="hidden" name="redirect" value="<?php echo $_SERVER['QUERY_STRING']; ?>" />
            <button type="submit" name="submit"><?php echo read_xmls('/site/frontend/contact/lables/send') ?></button>
          </div>
          <div class="col-md-3 col-sm-3 col-12">
            <label>&nbsp;</label>
            <button  type="reset" name="reset"><?php echo read_xmls('/site/frontend/contact/lables/reset') ?></button>
          </div>
          <div class="clear"></div>
        </form>

        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<!-- Contact Form Section END -->
