<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SubjectEdit', '_manage.php');

if (empty($_GET['id'])) {
    $session->message(read_xmls('/site/msg/selectitem'));
    redirect_to("_manage.php");
}

$subject = Subject::find_by_id(intval($_GET['id']));
$user_admin = User::find_by_id($session->user_id);

if (!empty($_GET['clear_photo']) && $session->check_permission('PhotoDelete', '_edit.php?id=' . $subject->id)) {

    if (Photographs::check_file_exist($subject->photo)) {
        $cur_photo = Photographs::find_by_id($subject->photo);
        if ($cur_photo->id) {
            $cur_photo->destroy();
        }
    }
    Subject::update_by_field('photo', 0, "WHERE id=" . $subject->id);
    redirect_to('_edit.php?id=' . $subject->id);
}

if (check_var("submit", "POST")) {
  if(!checkToken($_POST['_token'])){
    $session->message(read_xmls('/site/msg/invalidsubmit'));
    redirect_to("_manage.php");
  }

    $subjects = new Subject();
    $subjects->id = $_GET['id'];
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
    @$subjects->lang_id = $subject->lang_id;
    @$subjects->sort_id = $subject->sort_id;
    @$subjects->publish = $subject->publish;
    @$subjects->created = $subject->created;
    @$subjects->updated = current_date();

    //subjects object
    if (empty($_FILES['photo']['name'])) {
        $subjects->photo = $subject->photo;
    } else if (strstr($_FILES['photo']['type'], '/', true) != 'image') {
        $session->message(read_xmls('/site/photos/msg/notphoto'));
        redirect_to("_edit.php?id=" . $subject->id);
    } else {
        //drop current photo
        if (!empty($subject->photo) && Photographs::check_file_exist($subject->photo)) {
            $cur_photo = Photographs::find_by_id($subject->photo);
            if ($cur_photo->id) {
                $cur_photo->destroy();
            }
        }

        $new_sort_id = Photographs::count_new_sort_id();
        @$photo = new Photographs();
        @$photo->caption = trim($_POST['title']);
        @$photo->sort_id = $new_sort_id;
        @$photo->site_id = $session->site_id;
        @$photo->parent_type = Subject::$trans_key;
        @$photo->publish = 1;
        @$photo->max_width = 1000;
        @$photo->max_height = 1000;
        @$photo->max_width_thumb = 100;
        @$photo->max_height_thumb = 100;
        @$photo->attatch_file($_FILES['photo']);

        if ($photo->save_photo()) {
            echo log_action("Add New Photo: {$subjects->title}", "By: {$user_admin->username}");
        } else {
            $session->message(join("<br/>", $photo->errors));
        }
        $subjects->photo = $photo->id;
    }

    if ($subjects->save_subject($subject->id)) {
        $session->message(read_xmls('/site/msg/sucupdate'));
        echo log_action("Update Subject: {$subjects->title} ", "By: {$user_admin->username}");
        redirect_to("_edit.php?id=" . $subject->id);
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

    $(document).ready(function () {
        $("a#single").fancybox({
            'opacity': true,
            'overlayShow': true,
            'overlayColor': '#333',
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'titlePosition': 'over'
        });
    });
</script>

  <!-- /.row -->
<?php echo output_message($message); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="col-8"><?php echo read_xmls('/site/subject/titles/edit') ?>: <?php echo title($subject->title); ?></h2>
                <a class="btn btn-primary pull-left margin-link col-2" href="_manage.php?main_id=<?php echo $subject->main_id; ?>"><?php echo read_xmls('/site/subject/titles/manage') ?>
                    <i class="fa fa-th-list"></i>
                </a>

                <?php if ($session->has_permission('SubjectTranslate')) { ?>
                    <a class="btn btn-info pull-left col-2"  href="_translate.php?parent=<?php echo $subject->id; ?>"><?php echo read_xmls('/site/adminactions/translate') ?><i class="fa fa-language margin-right-fivePx"></i></a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form name="subject" action="_edit.php?id=<?php echo $subject->id; ?>" method="POST" enctype="multipart/form-data">
                          <?php echo setToken() ?>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/subject/lables/name') ?></label>
                                 <input class="form-control" type="text" name="title" value="<?php echo $subject->title; ?>" maxlength="255" />
                                     <?php echo read_xmls('/site/subject/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/urlalias') ?></label>
                                 <input class="form-control" name="url_alias" type="text" id="url_alias" value="<?php echo $subject->url_alias; ?>" onkeyup="javascript:checkInvalidCharsNoWhitEmpty(this);"/>
                                     <?php echo read_xmls('/site/subject/lables/charnum') ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/date') ?></label>
                                 <input class="form-control" name="subject_date" type="text" id="subject_date" onkeypress='return isNumberKey(event)' value="<?php echo Subject::calender_date($subject->subject_date); ?>" maxlength="                     19"/>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/photo') ?></label>
                                 <input class="form-control" name="photo" type="file" id="photo"/>
                                     <?php if (!empty($subject->photo)) { ?>
                                     <br />
                                         <a title="<?php echo $subject->title; ?>" href="<?php echo Photographs::get_image($subject->photo, 'larg'); ?>" target="_blank" id="single"><img src="<?php echo Photographs::get_image($subject->photo, 'small'); ?>" width="50"></a> <a href="                     ?id=<?php echo $subject->id; ?>&clear_photo=do" onclick="return confirmation('<?php                      echo read_xmls('/site/adminactionconf/confirmdelete') ?>');"><?php echo read_xmls('/site/adminactions/delete') ?></a>
                                     <?php } ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/main/titles/main') ?></label>

                                     <select  class="form-control" name="main_id" id="parent_id">
                                             <!-- <option value="Null">..<?php //echo read_xmls('/site/main/lables/toplevel'); ?></option> -->
                                             <?php
                                             //Get all MainCategorys
                                             $mainParents = MainCategory::find_all("sort_id ASC", " WHERE site_id={$session->site_id}");
                                             foreach ($mainParents as $mainParent):
                                                 $childrins[$mainParent->id] = array(
                                                     'id' => $mainParent->id,
                                                     'title' => $mainParent->title,
                                                     'parent_id' => $mainParent->parent_id
                                                 );
                                             endforeach;
                                             echo MainCategory::generate_tree_options($childrins, NULL, "&nbsp;&nbsp;", 'options', $subject->main_id);
                                             ?>
                                         </select>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/contentshort') ?></label>
                                 <textarea class="form-control" name="content_short" class="short_desc"><?php echo $subject->content_short ?></textarea>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/content') ?></label>
                                 <?php
                                     $getValue = $subject->content;
                                     $getField = 'content';
                                     $getBaseFolder = '../../aids/ckeditor/';
                                     $getType = 'larg';
                                     include('../../aids/editor.php');
                                     ?>
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/subject/lables/keywords') ?></label>
                                 <textarea class="form-control" name="keywords" cols="30" rows="5"><?php echo $subject->keywords; ?></textarea>
                            </div>
                            <div class="form-group">
                            <label><?php echo read_xmls('/site/subject/lables/description') ?></label>
                                 <textarea class="form-control" name="description" cols="30" rows="5"><?php echo $subject->description; ?></textarea>
                            </div>
                            <div class="form-group">
                               <label><?php echo read_xmls('/site/subject/lables/showdate') ?></label>
                                 <input type="checkbox" name="show_date" value="1" <?php
                                     if ($subject->show_date == 1) {
                                echo ' checked';
                                     }
                                     ?>/>
                            </div>
                            <div class="form-group">
                                <label><?php echo read_xmls('/site/subject/lables/allowfbcomment') ?></label>
                                 <input type="checkbox" name="fbcomment" value="1" <?php
                                     if ($subject->fbcomment == 1) {
                                         echo ' checked';
                                     }
                                     ?>/>
                            </div>
                             <div class="form-group">
                                 <input type="submit" name="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class                     ="btn btn-primary"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
