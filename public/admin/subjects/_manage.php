<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('SubjectView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<script type="text/javascript">
    jQuery_1_3_2(document).ready(function () {
        jQuery_1_3_2("a#single").fancybox({
            'opacity': true,
            'overlayShow': true,
            'overlayColor': '#333',
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'titlePosition': 'over'
        });
    });
</script>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Subject();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('SubjectEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Move Up
if (check_var("sort_up", "POST") && check_var("main_id", "POST") && check_var("check", "POST") && $session->check_permission('SubjectMove', '_manage.php')) {
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, " AND main_id=" . $_POST['main_id'] . " ");
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("main_id", "POST") && check_var("check", "POST") && $session->check_permission('SubjectMove', '_manage.php')) {
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE, " AND main_id=" . $_POST['main_id'] . " ");
}

// Do Resort
if (check_var("resort", "POST") && check_var("main_id", "POST") && $session->check_permission('SubjectMove', '_manage.php')) {
    if (Subject::resort($_POST['main_id'], 'main_id')) {
        redirect_to("./" . get_current_page());
        //echo "OK";
    }
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('SubjectPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('SubjectPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('SubjectTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('SubjectDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}
?>

<form name="assign" action="<?php echo get_current_page(); ?>" method="POST">

    <?php echo read_xmls('/site/main/titles/main') ?>:
    <select  class="form-control"  name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'main_id', ''); ?>')">
            <option value="Null">..<?php echo read_xmls('/site/main/lables/toplevel'); ?></option>
            <?php
            $mainParents = MainCategory::find_all("sort_id ASC", " WHERE site_id={$session->site_id}");
            foreach ($mainParents as $mainParent):
             if (check_var('main_id', 'GET') ) {
                $main_id=check_var('main_id', 'GET');
              } else {
                $main_id=$mainParent->id;
              }
                $childrins[$mainParent->id] = array(
                    'id' =>   $mainParent->id,
                    'title' => $mainParent->title.'('.Subject::count_all("WHERE main_id=" . $mainParent->id).')',
                    'parent_id' => $mainParent->parent_id
                );
            endforeach;
            echo MainCategory::generate_tree_options($childrins, NULL, "&nbsp;&nbsp;", 'options', $main_id);
            ?>
        </select>

</form>
<br />

<?php
if (isset($_GET['main_id']) && !empty($_GET['main_id'])) {
    $main_id = intval($_GET['main_id']);
    $main_subject_req = MainCategory::find_all('sort_id ASC', "WHERE id={$main_id}");
    $main_subject_req = $main_subject_req[0];
// start pagination
    $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
    if (SiteConfig::site_config('paging'))
        $per_page = SiteConfig::site_config('paging');
    else
        $per_page = 20;
    $total_count = Subject::count_all("WHERE main_id=" . $database->escape_value($main_id) . " AND (" . Subject::search(@$_GET['s'], array('title', 'url_alias', 'content_short', 'content', 'keywords', 'description')) . ") ");

    $pagination = new Pagination($page, $per_page, $total_count);
    $sql = "SELECT * FROM subjects WHERE main_id=" . $database->escape_value($main_id) . " ";
    if (!empty($_GET['s'])) {
        $sql .= "AND (" . Subject::search(@$_GET['s'], array('title', 'url_alias', 'content_short', 'content', 'keywords', 'description')) . ") ";
    }
    $sql .= "ORDER BY sort_id {$main_subject_req->subject_sort} ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $subjectObjs = Subject::find_by_sql($sql);
    ?>
    <?php
    $hidden_input = "<input type='hidden' name='main_id' value='" . @$main_id . "' />";
    ?>

  <!-- message -->
<div class="row">
    <div class="col-lg-12">
        <?php echo output_message($message); ?>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><?php echo read_xmls('/site/subject/titles/manage') ?></h2>
                <?php if ($session->has_permission('SubjectAdd')) { ?>
                    <a style="color: #fff;"  class="pull-left btn btn-primary" href="_add.php"><?php echo read_xmls('/site/subject/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                    <?php echo setToken() ?>
                  <?php echo $hidden_input?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                             <tr>
                                <th><?php echo read_xmls('/site/subject/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/subject/lables/link') ?></th>
                                <th><?php echo read_xmls('/site/subject/lables/photo') ?></th>
                                <th><?php echo read_xmls('/site/subject/lables/counter') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                             foreach ($subjectObjs as $subjectObj):
                                $subject_title = Subject::find_viewed_language('title', intval($subjectObj->id), Subject::$trans_key);
                                ?>
                                <tr>
                                    <td><?php echo $subject_title ?></td>
                                    <td align="center" valign="middle"><input type="text" value="<?php echo FILE_RELATIVE . DS . "?module=" . Module::find_alias('module_main_subject.php') . "&main_subject=" . $main_subject_req->url_alias . "&subject=" . $subjectObj->url_alias ?>" style="width:200px" /></td>
                                    <td align="center" valign="middle">
                                        <?php if (!empty($subjectObj->photo)) { ?>
                                            <a title="<?php $subject_title ?>" href="<?php echo Photographs::get_image($subjectObj->photo, 'larg'); ?>"  id="single"><img src="<?php echo Photographs::get_image($subjectObj->photo, 'small'); ?>" width="50"></a><?php
                                        } else {
                                            echo "-";
                                        }
                                        ?></td>
                                    <td align="center" valign="middle"><?php echo $subjectObj->counter; ?></td>
                                    <td align="center" valign="middle"><?php echo show_published($subjectObj->publish); ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $subjectObj->id; ?>" name="check[]" title="<?php echo $subjectObj->title; ?>" <?php
                                        if ((is_array($checked_row) && in_array($subjectObj->id, $checked_row)) || check_var("checked_row", "GET") == $subjectObj->id) {
                                            echo "checked='checked'";
                                        }
                                        ?>/></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                     <table class="button-table" style="float: right;" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('SubjectMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('SubjectMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  />
                                    <?php } ?>
                                    <?php if ($session->has_permission('SubjectPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                        <input class="btn btn-success" name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('SubjectPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('SubjectTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                        <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('SubjectEdit')) { ?>
                                        <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('SubjectDelete')) { ?>
                                        <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                        <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"/>
                                    <?php } ?>
                                </div></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php } ?>
<?php include_layout_template('admin_footer.php'); ?>
