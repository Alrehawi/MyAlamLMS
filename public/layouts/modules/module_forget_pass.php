<?php global $session, $page_title, $hide_title; ?>
<script type="text/javascript">
    function validate() {
        with (forget) {
            if (validate_email(email, "<?php echo read_xmls('/site/frontend/msg/validemail') ?>") == false) {
                document.forget.email.focus();
                return false
            }
        }
    }
</script>
<?php if (!$hide_title) { ?>
    <h1><span><?php echo $page_title; ?></span></h1>
    <br />
<?php } ?>
<div class="fillupform clear">
    <form name="forget" action="?do_forget_pass=do" method="POST" enctype="multipart/form-data" onSubmit="return validate();">
      <?php echo setToken() ?>
        <ul>
            <li>
                <label><?php echo read_xmls('/site/register/lables/email') ?></label>
                <input name="email" type="text"/>
            </li>
            <li>
                <label>&nbsp;</label>
                <input type="submit" name="submit" value="<?php echo read_xmls('/site/frontend/login/send') ?>" class="btn"/>
            </li>
    </form>
</div>
