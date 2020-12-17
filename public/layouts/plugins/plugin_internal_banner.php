<?php
$array_banners = array('teachers-heading', 'events-heading', 'about-heading', 'gallery-heading', 'news-heading');
$k = array_rand($array_banners);
$v = $array_banners[$k];
?>
<div class="<?php echo $v; ?> page-heading">
    <div class="container">
        <div class="row">
            <div class="col-md-12 <?php echo read_xmls('/site/config/otheralign') ?>">
                <div class="bg_banner_txt">
                    <h1><?php echo read_xmls('/site/frontend/home/sitename') ?></h1>
                    <span><?php echo read_xmls('/site/frontend/home/sitebrief') ?></span>
                </div>
                <div class="page-list">
                    <?php include('layouts/plugins/plugin_navigation.php'); ?>
                </div>
            </div>	
        </div>
    </div>
</div>