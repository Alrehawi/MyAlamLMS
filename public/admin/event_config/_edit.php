<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("../login/"); }
$session->check_permission('EventConfigEdit' , '../');
?>
<?php
$event_config = EventConfig::find_all('id ASC',"WHERE site_id={$session->site_id} ");
$event_config = @$event_config[0];
$count_all = EventConfig::count_all();
$user_admin = User::find_by_id($session->user_id);

if(check_var("submit" , "POST")){
	if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

	$event_configs = new EventConfig();
	if($count_all > 0){
		@$event_configs->id = $_GET['id'];
	}
	@$event_configs->today = trim($_POST['today']);
	@$event_configs->event_date = Event::sql_date(trim($_POST['event_date']));
	@$event_configs->updated = current_date();
        @$event_configs->site_id = $session->site_id;

	if($count_all < 1){
		//add new record
		if($event_configs->save_event_config()){
			$session->message(read_xmls('/site/msg/sucupdate'));
			echo log_action("Add Site Config" , "By: {$user_admin->username}");
			redirect_to("_edit.php");
		} else {
			$message = join("<br/>",$event_configs->errors);
		}
	} else {
		//update new record
		if($event_configs->save_event_config($event_config->id)){
			$session->message(read_xmls('/site/msg/sucupdate'));
			echo log_action("Update Event Config " , "By: {$user_admin->username}");
			redirect_to("_edit.php");
		} else {
			$message = join("<br/>",$event_configs->errors);
		}
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
		$("#event_date").calendar();
	});
//]]>
</script>

  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/eventconfig/titles/edit')?><?php echo @$event_config->title; ?></h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="event_config" action="_edit.php?id=<?php echo @$event_config->id;?>" method="POST" enctype="multipart/form-data">
													<?php echo setToken() ?>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/eventconfig/lables/eventdate')?></label>
                                <input type="checkbox" name="today" value="1" <?php if(@$event_config->today==1) echo "checked"?>  onclick="showMe('event_date_div')"/> <?php echo read_xmls('/site/eventconfig/lables/today')?><br />
                                    <div id="event_date_div" <?php if(@$event_config->today==1) echo " style='display:none;'"?>>
                                    <input class="form-control"  name="event_date" type="text" id="event_date" value="<?php echo Event::calender_date(@$event_config->event_date); ?>"/>
                                    </div>
                            </div>
                            <div class="form-group">
                                <tr>
                                  <td><?php echo read_xmls('/site/eventconfig/lables/updated')?></td>
                                  <td><?php echo @$event_config->updated; ?></td>
                                </tr>
                            </div>
                            <div  class="form-group">
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
