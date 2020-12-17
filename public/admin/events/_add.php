<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("../login/"); }
$session->check_permission('EventAdd' , '_manage.php');
?>
<?php

if(check_var("submit" , "POST")){
	if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }
	$user_admin = User::find_by_id($session->user_id);
	$new_sort_id = Event::count_new_sort_id("WHERE  site_id={$session->site_id} and STR_TO_DATE(`start_date`,'%Y-%m-%d') = '". simple_date(Event::sql_date(trim($_POST['start_date'])))."'");
	$events = new Event();
	@$events->title = trim($_POST['title']);
	@$events->has_link = trim($_POST['has_link']);
	@$events->url = trim($_POST['url']);
	@$events->target = trim($_POST['target']);
	@$events->start_date = Event::sql_date(trim($_POST['start_date']));
	@$events->end_date = Event::sql_date(trim($_POST['end_date']));
	@$events->location = trim($_POST['location']);
	@$events->sort_id = $new_sort_id;
	@$events->site_id = $session->site_id;
	@$events->publish = 1;
	@$events->created = current_date();
	// get default lang ID
	$default_lang = Language::get_default_lang();
	$events->lang_id = $default_lang[0]->id;


	if($events->save_event()){
		$payload['new_event'] =array('id'=>$events->id);
		//pushNotification('new_event' , $events->title , $events->start_date.' - '.$events->location , '' , $payload);

		$session->message(read_xmls('/site/msg/sucuadd'));
		echo log_action("Add New Event: {$events->title} " , "By: {$user_admin->username}");
		redirect_to("_add.php");
	} else {
		$message = join("<br/>",$events->errors);
	}
}
?>
<?php
	include_layout_template('admin_header.php');
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

  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/event/titles/add')?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/event/titles/manage')?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_add.php" method="POST" enctype="multipart/form-data">
													<?php echo setToken() ?>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/name')?></label>
                               <input class="form-control" type="text" required name="title" value="<?php echo check_var("title" , "POST"); ?>" maxlength="255" />
                            </div>

                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/startdate')?></label>
                               <input class="form-control" name="start_date" type="text" id="start_date" value="<?php echo check_var("start_date" , "POST"); ?>" maxlength='50' class="calendarFocus" />
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/enddate')?></label>
                               <input class="form-control" name="end_date" type="text" id="end_date" value="<?php echo check_var("end_date" , "POST"); ?>" maxlength='50'  class="calendarFocus"/>
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/location')?></label>
                               <input class="form-control" name="location" type="text" id="location" value="<?php echo check_var("location" , "POST"); ?>" maxlength="255" />
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/event/lables/haslink')?></label>
                              <input type="checkbox" name="has_link" value="1" <?php if(@$_POST['has_link']==1) echo "checked"?>  onclick="showMe('has_link_div')"/>
                                <div id="has_link_div"<?php if(@$_POST['has_link']==0) echo " style='display:none;'"?>>
                                  <input  class="form-control" type="text" name="url" maxlength="255" value="<?php echo empty($_POST['url']) ? "http://" : @$_POST['url']; ?>"/>
                                    <?php echo read_xmls('/site/event/lables/target')?>:
                                    <select  class="form-control" name="target" style="width:90px;">
                                        <option value="_blank"<?php if(@$_POST['target'] == '_blank') echo ' selected';?>>_blank</option>
                                        <option value="_self"<?php if(@$_POST['target'] == '_self') echo ' selected';?>>_self</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                               <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add')?>"  class="button"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php');?>
