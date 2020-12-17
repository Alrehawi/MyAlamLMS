<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('VoteQuestionView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<script type="text/javascript">
    jQuery_1_3_2(document).ready(function () {
        jQuery_1_3_2("a#preview").fancybox({
            'width': '60%',
            'height': '50%',
            'autoScale': true,
            'type': 'iframe',
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
$Action = new VoteQuestion();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('VoteQuestionEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}
// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('VoteQuestionTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}
// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('VoteQuestionDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('VoteQuestionPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}


// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('VoteQuestionPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}
?>


<?php
// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = VoteQuestion::count_all("WHERE site_id={$session->site_id} and  " . VoteQuestion::search(@$_GET['s'], array('title')) . " ");
$pagination = new Pagination($page, $per_page, $total_count);

$sql = "SELECT * FROM vote_questions WHERE site_id={$session->site_id} ";
if (!empty($_GET['s'])) {
    $sql .= " and  " . VoteQuestion::search(@$_GET['s'], array('title')) . " ";
}
$sql .= " ORDER BY id DESC ";
$sql .= " LIMIT {$per_page} ";
$sql .= " OFFSET {$pagination->offset()}";

$VoteQuestions = VoteQuestion::find_by_sql($sql);
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
            <h2><?php echo read_xmls('/site/votequestion/titles/manage') ?> (<?php echo VoteQuestion::count_all("WHERE site_id={$session->site_id}") ?>)</h2>
                 <?php if ($session->has_permission('VoteQuestionAdd')) { ?>
                    <a style="color: #fff;"  class="pull-left btn btn-primary" href="_add.php"><?php echo read_xmls('/site/votequestion/titles/add') ?><i class="fa fa-plus"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/votequestion/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/vote/lables/result') ?></th>
                                <th><?php echo read_xmls('/site/voteanswer/titles/add') ?></th>
                                <th  class="no-sort" width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($VoteQuestions as $VoteQuestion):
                                ?>
                                <tr>
                            <td><a href="../voteanswers/_manage.php?question_id=<?php echo $VoteQuestion->id; ?>"><?php echo VoteQuestion::find_viewed_language('title', intval($VoteQuestion->id), VoteQuestion::$trans_key) ?></a></td>
                            <td align="center" valign="middle">
                                <?php
                                /*      $_GET['results']="do";
                                  $vote=new Vote();
                                  @$vote->settings($VoteQuestion->id); */
                                echo "<a id='preview' href='_vote_result.php?vote_results=" . $VoteQuestion->id . "'>" . show_icon('vote.png', '', 'images') . "</a>";
                                ?>
                            </td>
                            <td align="center" valign="middle"><a href="<?php echo get_relative_link(ADMIN . DS . 'voteanswers' . DS . '_add.php?question_id=' . $VoteQuestion->id) ?>"><?php echo show_icon('add.png', read_xmls('/site/voteanswer/titles/add')); ?></a></td>
                            <td align="center"><?php echo show_published($VoteQuestion->publish); ?></td>
                            <td align="center"><input type="checkbox" value="<?php echo $VoteQuestion->id; ?>" name="check[]" title="<?php echo $VoteQuestion->title; ?>" <?php
                                if ((is_array($checked_row) && in_array($VoteQuestion->id, $checked_row)) || check_var("checked_row", "GET") == $VoteQuestion->id) {
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
                                <?php if ($session->has_permission('VoteQuestionPublish')) { ?>
                                    <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                    <input class="btn btn-success" name="publish" type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish"  class="button"/>
                                <?php } ?>
                                <?php if ($session->has_permission('VoteQuestionPublish')) { ?>
                                    <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                    <input class="btn btn-primary" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish" class="button" />
                                <?php } ?>
                                <?php if ($session->has_permission('VoteQuestionTranslate')) { ?>
                                    <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                    <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                <?php } ?>
                                <?php if ($session->has_permission('VoteQuestionEdit')) { ?>
                                    <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                    <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                <?php } ?>
                                <?php if ($session->has_permission('VoteQuestionDelete')) { ?>
                                    <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                                    <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                                <?php } ?>
                            </div></td>
                        </tr>
                 </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>
