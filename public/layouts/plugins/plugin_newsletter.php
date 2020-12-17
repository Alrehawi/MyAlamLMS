<?php global $session; ?>
<?php echo get_js('ajaxsbmt.js'); ?>
<?php if (MailGroup::count_all("WHERE newsletter=1 AND site_id={$session->site_id}")) { ?>

    <!--Newsletter-->

    <div class="newsletterbar">
        <div id="newsletter_wrap">

            <!-- Start Newsletter Left -->
            <div id="newsletter_left">
                <div id="newsletter_headline"><?php echo read_xmls('/site/frontend/home/laith') ?></div>
                <div id="newsletter_sub"><?php echo read_xmls('/site/frontend/home/enjoy') ?> <span class="bold color"><?php echo read_xmls('/site/frontend/home/bath') ?></span></div>
            </div>
            <!-- End Newsletter Left -->

            <!-- Start Newsletter Right -->
            <div id="newsletter_right">

                <!--Form-->
                <form id='contactus' action="actions/newsletter.php" name="newsletter" enctype="multipart/form-data" onsubmit="xmlhttpPost('actions/newsletter.php', 'newsletter', 'newsletter_result', '<?php echo read_xmls('/site/adminactions/loading') ?>', 1);
                        return false;">
                        <?php echo setToken() ?>
                    <input  name="email" id="email" type="text" value="<?php echo read_xmls('/site/frontend/newsletter/enteremail') ?>" onfocus="do_action('email', '<?php echo read_xmls('/site/frontend/newsletter/enteremail') ?>')"/>
                    <input type="submit" value="<?php echo read_xmls('/site/frontend/newsletter/join') ?>" class="button highlight small" />
                    <div id="newsletter_result" onmousemove="return hide_message();"></div>
                </form>
            </div>
            <!-- End Newsletter Right -->

        </div>
    </div>
    <!--End Newsletter-->

    <?php
} else {
    echo "<div id='newsletter_result'>" . read_xmls('/site/frontend/msg/donthavedefaultnewsletter') . "</div>";
}
?>
