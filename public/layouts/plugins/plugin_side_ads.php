<div class="clean"></div>
<?php
global $session, $sec_id;

if (empty($sec_id)) {
    echo read_xmls("/site/msg/pluginnosec");
} else {
    $ads = Ad::find_by_adsec($sec_id, ' ORDER BY sort_id ASC LIMIT 10 ');
    foreach ($ads as $ad):
        if ($ad->ad_type == 'flash') {
            echo "<div style='margin:auto auto;width:160px;border:1px solid #ccc; padding:0 0 1px 0;'>" . File::show_flash($ad->photo) . "</div><div class='clean'>&nbsp;</div>";
        } else {
			if(isset($_GET['gallery']) || isset($_GET['subject'])){ $classNameForAds="ads_img";	} else {$classNameForAds="";}
            ?>
            <a  href="<?php echo $ad->url; ?>" target="<?php echo $ad->target; ?>" >
                <img src="<?php echo Photographs::get_image($ad->photo, 'larg'); ?>" title="<?php echo Ad::find_viewed_language('title', $ad->id, 'ad') ?>" class="<?php echo $classNameForAds;?>" />
            </a>
            <div class="clean"></div>
            <?php
        }
    endforeach;
}
$sec_id=0;
?>
