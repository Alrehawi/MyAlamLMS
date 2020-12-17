<!--Search-->
<div class="box1">
    <form  name="search" action="?module=<?php echo Module::find_alias('module_search.php'); ?>" method="get" id="searchform">
      <?php echo setToken() ?>
        <input type="hidden" name="module" value="<?php echo Module::find_alias('module_search.php'); ?>" />
        <fieldset class="search">
            <input type="text" class="field" id="searchs" name="search" value="<?php
            if (@$_GET['search']) {
                echo @trim($_GET['search']);
            } else {
                echo read_xmls('/site/frontend/search/search') . "...";
            }
            ?>" onfocus="do_action('searchs', '<?php echo read_xmls('/site/frontend/search/search') . "..."; ?>')"/>
            <input type="hidden" name="submit" value="Search" />
            <button class="btn"></button>
        </fieldset>
    </form>

</div>
