<?php global $hidden_input; ?>
<!-- Search-->
<div class="search">
    <form action="./<?php echo get_current_page(); ?>" method="GET">
        <input type="text" name="s" value="<?php echo @$_GET['s'] ?>" style="width:200px;" />
        <input type="submit" name="search" value="<?php echo read_xmls('/site/adminactions/search') ?>.." class="button" />
        <?php echo @$hidden_input ?>
    </form>
</div>
