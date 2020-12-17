<!--Featured Projects-->
<div class="centerbar">
    <div class="featuredprojects">

        <h4><?php echo Plugin::find_viewed_language('title', 15, Plugin::$trans_key) ?></h4>
        <div class="clearsmall"></div>

        <div class="coda-slider-wrapper">
            <div class="coda-slider preload" id="coda-slider-1">

                <!-- Slide -->
                <div class="panel">
                    <div class="panel-wrapper">

                        <div class="project">
                            <?php
                            $medias = Media::find_all("sort_id ASC LIMIT 4", "WHERE publish=1 AND site_id={$session->site_id}");
                            foreach ($medias as $media):
                                if ($media->media_type == 'youtube') {
                                    $youtubeparam = doubleExplode('v=', '&', $media->url);
                                    $youtubeparam = array_shift(@array_values($youtubeparam));
                                    $imgTag = "<img src=\"http://i2.ytimg.com/vi/" . $youtubeparam . "/mqdefault.jpg\" height=\"160\" />";
                                } else {
                                    $imgTag = "<img src=\"" . $media->get_image($media->id, 'larg', $media->gallery_id) . "\"  style=\"height:160px; width:209px;\" />";
                                }
                                ?>
                                <div class="featured featured-first">
                                    <?php echo $imgTag ?>
                                    <div class="mask">
                                        <h2><?php echo Media::find_viewed_language('title', $media->id, Media::$trans_key) ?></h2>
                                        <?php if ($media->media_type == 'image') { ?>
                                            <a  title="<?php echo $media->title; ?>" href="<?php echo $media->get_image($media->id, 'larg', $media->gallery_id); ?>" class="image" rel="prettyPhoto[]"></a>
                                        <?php } else if ($media->media_type == 'youtube') {
                                            ?>
                                            <a  title="<?php echo $media->title; ?>" href="http://www.youtube.com/watch?v=<?php echo $youtubeparam; ?>" class="video" rel="prettyPhoto[]"></a>
                                        <?php } ?>

                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>

                    </div>
                </div>
                <!-- End Slide -->

            </div><!-- .coda-slider -->
        </div><!-- .coda-slider-wrapper -->

    </div>
    <div class="clearnospacing"></div>
</div>
<!--End Featured Projects-->
