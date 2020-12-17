<?php
global $session, $sec_id;

if (empty($sec_id)) {
    echo read_xmls("/site/msg/pluginnosec");
} else {
    ?>
    <div class="block maincat_menu">
        <?php
        $maincatmenuplugin = Plugin::find_by_id($sec_id);
        if ($maincatmenuplugin->show_title == 1) {
            ?>
            <h3><?php echo Plugin::find_viewed_language('title', $maincatmenuplugin->id, Plugin::$trans_key) ?></h3><br />
        <?php } ?>
        <ul>
            <?php
            //Get all MainCategorys
            $mains = MainCategory::find_all("sort_id ASC", "WHERE publish=1 AND site_id={$session->site_id}");
            foreach ($mains as $main):
                $childrins[$main->id] = array(
                    'id' => $main->id,
                    'url_alias' => $main->url_alias,
                    'title' => $main->title,
                    'parent_id' => $main->parent_id
                );

            endforeach;
            echo MainCategory::generate_tree_menu($childrins, $parent = NULL, $indent = "");
            ?>
        </ul>
    </div>
    <?php
}
$sec_id=0;
?>