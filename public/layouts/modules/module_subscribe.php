<?php global $session, $page_title, $hide_title; ?>
<script type="text/javascript">
    function validate() {
        with (contact) {
            if (document.contact.full_name.value == ''
                    || document.contact.gender.value == ''
                    || document.contact.birth_date.value == ''
                    || document.contact.profession.value == ''
                    || document.contact.nationality.value == ''
                    || document.contact.tel.value == ''
                    || document.contact.mobile.value == ''
                    || document.contact.email.value == ''
                    || document.contact.country.value == ''
                    || document.contact.captcha.value == ''
                    ) {
                alert('<?php echo read_xmls('/site/msg/allrequire') ?>');
                document.contact.full_name.focus();
                return false;
            }
            if (document.contact.email.value == '' ||
                    validate_email(email, "<?php echo read_xmls('/site/frontend/msg/validemail') ?>") == false) {
                document.contact.email.focus();
                return false;
            }
        }
    }
</script>

<?php
if (isset($_POST['submit'])) {
    echo include_action_file('subscribe.php');
}
?>
  <div class="body">
    <section class="three-fourth last">
    <form name="contact" id="contactus" action="" method="POST" enctype="multipart/form-data" onSubmit="return validate();">
      <?php echo setToken() ?>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/fullname') ?>*</label>
            <input type="text" name="full_name" value="<?php echo @$_POST['full_name'] ?>"/>
        </fieldset>

        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/gender') ?>*</label>
            <label><input name="gender" type="radio" value="1" <?php if (@$_POST['gender'] == 1) {   echo 'checked="checked"'; } ?> /> <?php echo read_xmls('/site/subscription/lables/male') ?></label>
            <label><input name="gender" type="radio" value="2" <?php if (@$_POST['gender'] == 2) { echo 'checked="checked"';  } ?> /> <?php echo read_xmls('/site/subscription/lables/female') ?></label>
        </fieldset>
        <?php if (@$session->alias == 'en') { ?>
          <fieldset class="one-fourth">&nbsp;</fieldset>
        <?php } ?>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/birthdate') ?>*</label>
            <input type="text"  name="birth_date" value="<?php echo @$_POST['birth_date'] ?>"/>
        </fieldset>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/profession') ?>*</label>
            <input type="text" name="profession" value="<?php echo @$_POST['profession'] ?>"/>
        </fieldset>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/nationality') ?>*</label>
            <input type="text" name="nationality" value="<?php echo @$_POST['nationality'] ?>"/>
        </fieldset>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/tel') ?>*</label>
            <input type="text" name="tel" value="<?php echo @$_POST['tel'] ?>" onkeypress='return isNumberKey(event)' maxlength="15"/>
        </fieldset>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/mobile') ?>*</label>
            <input type="text" name="mobile" value="<?php echo @$_POST['mobile'] ?>" onkeypress='return isNumberKey(event)' maxlength="15"/>
        </fieldset>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/email') ?>*</label>
            <input type="text" name="email" value="<?php echo @$_POST['email'] ?>"/>
        </fieldset>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/country') ?>*</label>
            <input type="text" name="country" value="<?php echo @$_POST['country'] ?>"/>
        </fieldset>
        <fieldset class="three-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/interests') ?></label>
            <textarea name="interests" style="width:91%;"><?php echo @$_POST['interests'] ?></textarea>
        </fieldset>
        <fieldset class="one-fourth">
            <label><?php echo read_xmls('/site/subscription/lables/captcha') ?>*</label>
            <input type="text" name="captcha" id="scaptcha" value="<?php echo @$_POST['captcha'] ?>"/>
            <label style="width:70px;"><img src="aids/captcha.php" class="captch"></label>
        </fieldset>
        <fieldset class="one">
            <input type="hidden" name="redirect" value="<?php echo $_SERVER['QUERY_STRING']; ?>" />
            <input type="submit" name="submit" value="<?php echo read_xmls('/site/subscription/lables/subscribe') ?>" class="button small color round">
            <input type="reset" name="reset" value="<?php echo read_xmls('/site/subscription/lables/reset') ?>" class="button small color round">
            <br><br>
        </fieldset>
      </form>
    </section>

  </div>
<div class="clear"></div>
