<?php global $session ,$database, $page_title, $hide_title;
echo get_js('calender' . DS . 'mootools-1.2.3-core-yc.js');
echo get_js('calender' . DS . 'mootools-1.2.3.1-more.js');
echo get_js('calender' . DS . 'mooECal' . read_xmls('/site/config/langalias') . '.js');
?>

<script type="text/javascript">

    window.addEvent('domready', function(){
    new Calendar({
    calContainer:'calBody',
<?php if (EventConfig::event_config('today') == 1) { ?>
        newDate:'<?php echo make_event_show_last(make_event_date(time())) ?>',
<?php } else { ?>
        newDate:'<?php echo make_event_show_last(Event::event_date(EventConfig::event_config('event_date'))) ?>',
<?php } ?>
    cEvents: [
<?php
$events = Event::find_all('sort_id ASC', "WHERE publish=1 AND site_id={$session->site_id}");
$count_event = 0;
foreach ($events as $event):
    $count_event++;
    if ($count_event != 1)
        echo ',';
    ?>
        {
    <?php if ($event->has_link) { ?>
            title:'<?php echo "<a href=" . $event->url . " target=" . $event->target . ">" . str_replace("'", "&rsquo;", Event::find_viewed_language('title', $event->id, Event::$trans_key)) . "</a>" ?>',
    <?php } else { ?>
            title:'<?php echo str_replace("'", "&rsquo;", Event::find_viewed_language('title', $event->id, Event::$trans_key)); ?>',
    <?php } ?>
        start:'<?php echo make_event_show_last(Event::event_date($event->start_date)) ?>',
                end:'<?php echo make_event_show_last(Event::event_date($event->end_date)) ?>',
                location:'<?php echo str_replace("'", "&rsquo;", Event::find_viewed_language('location', $event->id, Event::$trans_key)); ?>'
        }
<?php endforeach; ?>
    ]
    });
    })
</script>
<?php
echo get_css('calender' . DS . 'mooECalLarge'.read_xmls('/site/config/langalias').'.css', "id='calStyle'");
?>
<div class="clean">&nbsp;</div>
<div id="event" class="body">

    <div class="main">
        <!--		<div class="styleSizes">
                        <a href="change style" title="Use mooECalLarge.css" onclick="JJJ('calStyle').set('href','stylesheets/calender/mooECalLarge.css'); return false;" class="button_green"><?php //echo read_xmls('/site/frontend/events/larg')     ?></a>
                                <a href="change style" title="Use mooECal.css" onclick="JJJ('calStyle').set('href','stylesheets/calender/mooECal.css'); return false;" class="button_green"><?php //echo read_xmls('/site/frontend/events/normal')     ?></a>
                                <a href="change style" title="Use mooECalSmall.css" onclick="JJJ('calStyle').set('href','./stylesheets/calender/mooECalSmall_solid.css'); return false;" class="button_green"><?php //echo read_xmls('/site/frontend/events/small')     ?></a>

                        </div>-->
        <div id="calBody"></div>
    </div>
</div>
