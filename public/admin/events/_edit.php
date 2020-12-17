<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) { redirect_to("../login/"); }
$session->check_permission('EventEdit' , '_manage.php');
?>
<?php
if(empty($_GET['id'])){
	$session->message(read_xmls('/site/msg/selectitem'));
	redirect_to("_manage.php");
}
$event = Event::find_by_id($_GET['id']," AND site_id={$session->site_id}");
$user_admin = User::find_by_id($session->user_id);

if(check_var("submit" , "POST")){
	if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
	$events = new Event();
	@$events->id = $_GET['id'];
	@$events->title = trim($_POST['title']);
	@$events->has_link = trim($_POST['has_link']);
	@$events->url = trim($_POST['url']);
	@$events->target = trim($_POST['target']);
	@$events->start_date = Event::sql_date(trim($_POST['start_date']));
	@$events->end_date = Event::sql_date(trim($_POST['end_date']));
	@$events->location = trim($_POST['location']);
	@$events->publish = $event->publish;
	@$events->lang_id = $event->lang_id;
	@$events->sort_id = $event->sort_id;
        @$events->site_id = $event->site_id;
	@$events->created = $event->created;
	@$events->updated = current_date();

	if($events->save_event($event->id)){
		$session->message(read_xmls('/site/msg/sucupdate'));
		echo log_action("Update Event: {$events->title} " , "By: {$user_admin->username}");
		redirect_to("_edit.php?id=".$event->id);
	} else {
		$message = join("<br/>",$events->errors);
	}
}
?>
<?php include_layout_template('admin_header.php');
	echo get_js('calender'.DS.'claender_jquery.js');
	echo get_css('calender'.DS.'claender.css');
 ?>
 <script type="text/javascript">
//<![CDATA[
	$(document).ready(function (){
		$("#start_date, #end_date").calendar();
	});
//]]>
</script>
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/event/titles/edit')?>: <?php echo $event->title; ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/event/titles/manage')?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="event" action="_edit.php?id=<?php echo $event->id;?>" method="POST" enctype="multipart/form-data">
													<?php echo setToken() ?>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/name')?></label>
                               <input class="form-control" type="text"  value="<?php echo $event->title; ?>" required name="title" value="<?php echo check_var("title" , "POST"); ?>" maxlength="255" />
                            </div>

                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/startdate')?></label>
                               <input class="form-control" name="start_date" type="text" id="start_date" value="<?php echo Event::calender_date($event->start_date); ?>" maxlength='50' class="calendarFocus" />
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/enddate')?></label>
                               <input class="form-control" name="end_date" type="text" id="end_date" value="<?php echo Event::calender_date($event->start_date); ?>" maxlength='50' class="calendarFocus" maxlength='50'  class="calendarFocus"/>
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/location')?></label>
                               <input class="form-control" name="location" value="<?php echo $event->location; ?>" maxlength="255" />
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/haslink')?></label>
                               <input type="checkbox" name="has_link" value="1" <?php if(@$event->has_link==1) echo "checked"?>  onclick="showMe('has_link_div')"/>
                                <br />
                                <div id="has_link_div"<?php if(@$event->has_link==0) echo " style='display:none;'"?>>
                                  <input class="form-control" type="text" name="url" maxlength="255" value="<?php echo empty($event->url) ? "http://" : @$event->url; ?>"/>
                                  <?php echo read_xmls('/site/event/lables/target')?>:
                                  <select  class="form-control" name="target" style="width:90px;">
                                    <option value="_blank"<?php if(@$event->target == '_blank') echo ' selected';?>>_blank</option>
                                    <option value="_self"<?php if(@$event->target == '_self') echo ' selected';?>>_self</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit')?>"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php');?>
