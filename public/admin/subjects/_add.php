<?php
require_once('../../../includes/initialize.php');
//$session->logout();
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SubjectAdd', '_manage.php');
?>
<?php
if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    //Assign new sort id
    $new_sort_id = Subject::count_new_sort_id("WHERE main_id=" . @intval($_POST['main_id']));

    $user_admin = User::find_by_id($session->user_id);
    @$subjects = new Subject();
    @$subjects->title = trim($_POST['title']);
    @$subjects->url_alias = trim($_POST['url_alias']);
    @$subjects->subject_date = Subject::sql_date($_POST['subject_date']);
    @$subjects->show_date = trim($_POST['show_date']);

    @$subjects->main_id = $_POST['main_id'];
    @$subjects->content_short = trim($_POST['content_short']);
    @$subjects->content = trim($_POST['content']);
    @$subjects->keywords = trim($_POST['keywords']);
    @$subjects->description = trim($_POST['description']);
    @$subjects->fbcomment = trim($_POST['fbcomment']);
    @$subjects->sort_id = $new_sort_id;
    @$subjects->publish = 1;
    // get default lang ID
    @$default_lang = Language::get_default_lang();
    @$subjects->lang_id = $default_lang[0]->id;
    @$subjects->created = current_date();

    if (!empty($_FILES['photo']['name'])) {
        if (strstr($_FILES['photo']['type'], '/', true) == 'image') {
            $new_photo_sort_id = Photographs::count_new_sort_id();
            @$photo = new Photographs();
            @$photo->caption = trim($_POST['title']);
            @$photo->sort_id = $new_photo_sort_id;
            @$photo->site_id = $session->site_id;
            @$photo->parent_type = Subject::$trans_key;
            @$photo->publish = 1;
            @$photo->max_width = 1000;
            @$photo->max_height = 1000;
            @$photo->max_width_thumb = 100;
            @$photo->max_height_thumb = 100;
            @$photo->attatch_file($_FILES['photo']);
        } else {
            $session->message(read_xmls('/site/photos/msg/notphoto'));
            redirect_to("./_add.php");
        }

        if ($photo->save_photo()) {
            echo log_action("Add New Photo: " . trim($_POST['title']), "By: {$user_admin->username}");
        } else {
            $session->message(join("<br/>", $photo->errors));
        }

        @$subjects->photo = $photo->id;
    }

    if ($subjects->save_subject()) {
        //push mobile notificatin
        // $mainsNews=array(2,3,4,5,6,7,8,9,10,11,12,13,14,15);
        // if(in_array($subjects->main_id, $mainsNews)){
        //   @$photoSmall=get_relative_link().'photos/thumb/'.$photo->filename;
        //   @$payload['news'] =array('id'=>$subjects->id,'main_id'=>$subjects->main_id);
        //   pushNotification('news' , $subjects->title , $subjects->content_short , @$photoSmall , $payload);
        //
        // }
        $session->message(read_xmls('/site/msg/sucuadd'));
        echo log_action("Add New Subject: {$subjects->title} ", "By: {$user_admin->username}");
        redirect_to("_add.php");
    } else {
        $message = join("<br/>", $subjects->errors);
    }
}
?>
<?php
include_layout_template('admin_header.php');
echo get_js('calender' . DS . 'claender_jquery.js');
echo get_css('calender' . DS . 'claender.css');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#subject_date").calendar();
    });
</script>
  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/subject/titles/add') ?></h2>
                <a class="btn btn-primary pull-left" href="_manage.php"><?php echo read_xmls('/site/subject/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="photos" action="_add.php" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/subject/lables/name') ?></label>
                               <input class="form-control" type="text" name="title" value="<?php echo check_var("title", "POST"); ?>" maxlength="255">
                                <?php echo read_xmls('/site/subject/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/urlalias') ?></label>
                                <input class="form-control" name="url_alias" type="text" id="url_alias" value="<?php
                                if (@$_POST['url_alias']) {
                                    echo @$_POST['url_alias'];
                                } else {
                                    echo create_alias('subject');
                                }
                                ?>" onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                <?php echo read_xmls('/site/subject/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/date') ?></label>
                                <input class="form-control" name="subject_date" type="text" id="subject_date" onkeypress='return isNumberKey(event)' value="<?php echo make_calender_date();?>"  maxlength="19"/>
                            </div>
                            <div class="form-group">
                                <label valign="top"><?php echo read_xmls('/site/subject/lables/photo') ?></label>
                                 <input class="form-control" name="photo" type="file" id="photo"/>
                            </div>
                            <div class="form-group">
                                 <label valign="top"><?php echo read_xmls('/site/main/titles/main') ?></label>
                                 <select  class="form-control" name="main_id" id="parent_id">
                                         <!-- <option value="Null">..<?php //echo read_xmls('/site/main/lables/toplevel'); ?></option> -->
                                         <?php
                                          if(@$_GET['main_id']){$main_id=$_GET['main_id'];} else {$main_id=0;}
                                         //Get all MainCategorys
                                         $mains = MainCategory::find_all("sort_id ASC"," WHERE site_id={$session->site_id}");
                                         foreach ($mains as $main):

                                             $childrins[$main->id] = array(
                                                 'id' => $main->id,
                                                 'title' => $main->title,
                                                 'parent_id' => $main->parent_id
                                             );

                                         endforeach;
                                          echo MainCategory::generate_tree_options($childrins, NULL, "&nbsp;&nbsp;", 'options',$main_id);
                                         ?>
                                     </select>

                            </div>
                            <div class="form-group">
                                <label valign="top"><?php echo read_xmls('/site/subject/lables/contentshort') ?></label>
                                <textarea class="form-control" name="content_short"  class="short_desc"><?php echo check_var("content_short", "POST"); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label valign="top"><?php echo read_xmls('/site/subject/lables/content') ?></label>

                                <?php
                                $getValue = check_var("content", "POST");
                                $getField = 'content';
                                $getBaseFolder = '../../aids/ckeditor/';
                                $getType = 'larg';
                                include('../../aids/editor.php');
                                ?>
                            </div>
                            <div class="form-group">
                               <label valign="top"><?php echo read_xmls('/site/subject/lables/keywords') ?></label>
                               <textarea class="form-control" name="keywords" cols="30" rows="5"><?php echo check_var("keywords", "POST"); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label valign="top"><p><?php echo read_xmls('/site/subject/lables/description') ?></p>
                                    <p>&nbsp;</p></label>
                                <textarea class="form-control" name="description" cols="30" rows="5"><?php echo check_var("description", "POST"); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/showdate') ?></label>
                                <input type="checkbox" name="show_date" value="1" <?php
                                    if (check_var("show_date", "POST") == 1) {
                                        echo ' checked';
                                    }
                                    ?>/>
                            </div>
                            <div class="form-group">
                                 <label valign="top"><?php echo read_xmls('/site/subject/lables/allowfbcomment') ?></label>
                                <input type="checkbox" name="fbcomment" value="1" <?php
                                    if (check_var("fbcomment", "POST") == 1) {
                                        echo ' checked';
                                    }
                                    ?>/>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/add') ?>"  class="button">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
