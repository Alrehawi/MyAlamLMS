<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('VoteAnswerView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new VoteAnswer();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('VoteAnswerEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}
// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('VoteAnswerTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}
// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('VoteAnswerDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('VoteAnswerPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}


// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('VoteAnswerPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Move Up
if (check_var("sort_up", "POST") && check_var("question_id", "POST") && check_var("check", "POST") && $session->check_permission('VoteAnswerMove', '_manage.php')) {
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, " AND question_id=" . $_POST['question_id'] . " ");
}


// Do Move Down
if (check_var("sort_down", "POST") && check_var("question_id", "POST") && check_var("check", "POST") && $session->check_permission('VoteAnswerMove', '_manage.php')) {
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE, " AND question_id=" . $_POST['question_id'] . " ");
}
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
                <h2><?php echo read_xmls('/site/voteanswer/titles/manage') ?> </h2>
                <?php if ($session->has_permission('VoteQuestionView')) { ?>
                    <a style="color: #fff; margin-right: 10px"  class="pull-left btn btn-primary" href="../votequestions/_manage.php"><?php echo read_xmls('/site/votequestion/titles/main') ?><i class="fa fa-th-list" aria-hidden="true"></i></a>
                <?php } ?>
                <?php if ($session->has_permission('VoteQuestionAdd')) { ?>
                     <a style="color: #fff"  class="pull-left btn btn-primary" href="../votequestions/_add.php"><?php echo read_xmls('/site/votequestion/titles/add') ?><i class="fa fa-plus" aria-hidden="true"></i></a>
                <?php } ?>
            </div>

<form name="assign" action="<?php echo get_current_page(); ?>" method="POST">
  <?php echo setToken() ?>
    <?php echo read_xmls('/site/votequestion/titles/main') ?>:
    <select  class="form-control" name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'question_id', ''); ?>')">
        <option value=""><?php echo read_xmls('/site/adminactions/select') ?></option>
        <?php
        $questions = VoteQuestion::find_all("title ASC","WHERE site_id={$session->site_id}");
        foreach ($questions as $question):
            ?>
            <option value='<?php echo $question->id; ?>'<?php
            if (@$_GET['question_id'] == $question->id) {
                echo ' selected';
            }
            ?>><?php echo VoteQuestion::find_viewed_language('title', intval($question->id), VoteQuestion::$trans_key) ?></option>
<?php endforeach; ?>
    </select>
</form>
<br>

<?php
if (isset($_GET['question_id']) && !empty($_GET['question_id'])) {
    $question_id = intval($_GET['question_id']);

// start pagination
    $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
    if (SiteConfig::site_config('paging'))
        $per_page = SiteConfig::site_config('paging');
    else
        $per_page = 20;
    $total_count = VoteAnswer::count_all("WHERE question_id=" . $database->escape_value($question_id) . " AND (" . VoteAnswer::search(@$_GET['s'], array('title')) . ") ");
    $pagination = new Pagination($page, $per_page, $total_count);
    $sql = "SELECT * FROM vote_answers WHERE question_id=" . $database->escape_value($question_id) . " ";
    if (!empty($_GET['s'])) {
        $sql .= "AND (" . VoteAnswer::search(@$_GET['s'], array('title')) . ") ";
    }
    $sql .= "ORDER BY sort_id ASC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $VoteAnswers = VoteAnswer::find_by_sql($sql);
    ?>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/voteanswer/lables/name') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($VoteAnswers as $VoteAnswer):?>
                                <tr>
                                    <td><?php echo VoteAnswer::find_viewed_language('title', intval($VoteAnswer->id), VoteAnswer::$trans_key) ?></td>
                                    <td align="center"><?php echo show_published($VoteAnswer->publish); ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $VoteAnswer->id; ?>" name="check[]" title="<?php echo $VoteAnswer->title; ?>" <?php
                                                      if ((is_array($checked_row) && in_array($VoteAnswer->id, $checked_row)) || check_var("checked_row", "GET") == $VoteAnswer->id) {
                                                          echo "checked='checked'";
                                                      }
                                ?>/>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <table class="button-table" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('VoteAnswerPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                       <input class="btn btn-success" name="publish"  type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('VoteAnswerPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('VoteAnswerMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('VoteAnswerMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                        <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('VoteAnswerTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                        <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('VoteAnswerEdit')) { ?>
                                         <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                        <?php } ?>
                                        <?php if ($session->has_permission('VoteAnswerDelete')) { ?>
                                        <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                                    <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                                        <?php } ?>
                                    <input type="hidden" name="question_id" value="<?php echo $question_id ?>" />
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
