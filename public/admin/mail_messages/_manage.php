<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('MailView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<script type="text/javascript">
    jQuery_1_3_2(document).ready(function () {
        jQuery_1_3_2("a#preview").fancybox({
            'width': '75%',
            'height': '75%',
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
$Action = new MailMessage();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('MailDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}
?>

<?php
// start pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
if (SiteConfig::site_config('paging'))
    $per_page = SiteConfig::site_config('paging');
else
    $per_page = 20;
$total_count = MailMessage::count_all("WHERE " . MailMessage::search(@$_GET['s'], array('subject', 'content')) . " ");

$pagination = new Pagination($page, $per_page, $total_count);
$sql = "SELECT * FROM mail_messages ";
if (!empty($_GET['s'])) {
    $sql .= "WHERE " . MailMessage::search(@$_GET['s'], array('subject', 'content')) . " ";
}
$sql .= "ORDER BY id DESC ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";

$mailmessageObjs = MailMessage::find_by_sql($sql);
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
                 <h2><?php echo read_xmls('/site/mailmessage/titles/manage') ?></h2>
                <?php if ($session->has_permission('MailSend')) { ?>
                    <a class="pull-left btn btn-info" href="_send.php"><?php echo read_xmls('/site/mailmessage/titles/send') ?><i class="fa fa-send-o margin-right-fivePx" aria-hidden="true"></i></a>
                <?php } ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                            <tr>
                                <th><?php echo read_xmls('/site/mailmessage/lables/from') ?></th>
                                <th><?php echo read_xmls('/site/mailmessage/lables/subject') ?></th>
                                <th><?php echo read_xmls('/site/mailgroup/titles/main') ?></th>
                                <th><?php echo read_xmls('/site/mailmessage/lables/content') ?></th>
                                <th><?php echo read_xmls('/site/mailmessage/lables/date') ?></th>
                                <th class="no-sort"><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" emailmessage="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mailmessageObjs as $mailmessageObj):?>
                                <tr>
                                    <td><?php echo $mailmessageObj->from ?></td>
                                    <td valign="middle"><?php echo $mailmessageObj->subject ?></td>
                                    <td align="center" valign="middle"><?php echo MailGroup::find_viewed_language('title', intval($mailmessageObj->mail_groups_id), MailGroup::$trans_key) ?></td>
                                    <td align="center" valign="middle"><a id='preview' href="<?php echo '_preview.php?message_id=' . $mailmessageObj->id ?>"><?php echo show_icon('preview.png', read_xmls('/site/mailmessage/lables/preview')); ?></a></td>
                                    <td align="center"><?php echo datetime_to_text($mailmessageObj->created) ?></td>
                                    <td align="center"><input type="checkbox" value="<?php echo $mailmessageObj->id; ?>" name="check[]" emailmessage="<?php echo $mailmessageObj->subject; ?>" <?php if ((is_array($checked_row) && in_array($mailmessageObj->id, $checked_row)) || check_var("checked_row", "GET") == $mailmessageObj->id) {
                                echo "checked='checked'";
                            } ?>/></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                     <span class="button-table">
                        <?php if ($session->has_permission('MailDelete')) { ?>
                            <label for='delete' class="fa fa-remove" aria-hidden="true"></label>
                            <input class="btn btn-danger" name="dell" id='delete' type="submit" onclick="return confirmation('<?php echo read_xmls('/site/adminactionconf/confirmdelete') ?>');" value="<?php echo read_xmls('/site/adminactions/delete') ?>"  class="button"/>
                        <?php } ?>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include_layout_template('admin_footer.php'); ?>
