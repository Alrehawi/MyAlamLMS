<?php
require_once('../../../includes/initialize.php');

if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('EventView', '../');
?>
<?php include_layout_template('admin_header.php'); ?>
<?php
// Definitions (checke rows and object)
$checked_row = array();
$Action = new Event();

// declare POST or GET checked_row
define_checked(check_var("checked_row", "GET"), check_var("check", "POST"));

// Do Edit Action
if (check_var("edit", "POST") && check_var("check", "POST") && $session->check_permission('EventEdit', '_manage.php')) {
    return $Action->do_action('edit', $_POST['check'], '_edit.php', FALSE);
}

// Do Translate Action
if (check_var("translate", "POST") && check_var("check", "POST") && $session->check_permission('EventTranslate', '_manage.php')) {
    return $Action->do_action('translate', $_POST['check'], '_translate.php', FALSE);
}

// Do Delete Action
if (check_var("dell", "POST") && check_var("check", "POST") && $session->check_permission('EventDelete', '_manage.php')) {
    return $Action->do_action('dell', $_POST['check'], "_delete.php", TRUE);
}

// Do Publish
if (check_var("publish", "POST") && check_var("check", "POST") && $session->check_permission('EventPublish', '_manage.php')) {
    return $Action->do_action('publish', $_POST['check'], get_current_page(), TRUE);
}

// Do UnPublish
if (check_var("unpublish", "POST") && check_var("check", "POST") && $session->check_permission('EventPublish', '_manage.php')) {
    return $Action->do_action('unpublish', $_POST['check'], get_current_page(), TRUE);
}

// Do Move Up
if (check_var("sort_up", "POST") && check_var("check", "POST") && $session->check_permission('EventMove', '_manage.php')) {
    $start_date = Event::find_field_by_id('start_date', $_POST['check'][0]);
    return $Action->do_action('sort_up', $_POST['check'], get_current_page(), FALSE, " AND site_id={$session->site_id} AND STR_TO_DATE(`start_date`,'%Y-%m-%d') = '" . simple_date(Event::sql_date($start_date)) . "' ");
}

// Do Move Down
if (check_var("sort_down", "POST") && check_var("check", "POST") && $session->check_permission('EventMove', '_manage.php')) {
    $start_date = Event::find_field_by_id('start_date', $_POST['check'][0]);
    return $Action->do_action('sort_down', $_POST['check'], get_current_page(), FALSE, " AND site_id={$session->site_id} AND STR_TO_DATE(`start_date`,'%Y-%m-%d') = '" . simple_date(Event::sql_date($start_date)) . "' ");
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
                <h2><?php echo read_xmls('/site/event/titles/manage') ?></h2>
                <?php if ($session->has_permission('EventAdd')) { ?>
                    <a  class="pull-left btn btn-primary"  href="_add.php"><?php echo read_xmls('/site/event/titles/add') ?><i class="fa fa-plus"></i></a>
                <?php } ?>
            </div>

            <form name="assign" action="<?php echo get_current_page(); ?>" method="POST">

            <?php echo read_xmls('/site/event/titles/main') ?>:
                <select  class="form-control" name="drop" onChange="get_dropdown_id('<?php echo search_for_flag(get_current_page(), 'start_date', ''); ?>')">
                    <option value=""><?php echo read_xmls('/site/event/lables/startdate') ?></option>
                    <?php
                    $sql = "SELECT DISTINCT STR_TO_DATE(`start_date`,'%Y-%m-%d') AS title FROM events where site_id={$session->site_id} ";
                    $events = Event::find_by_sql($sql);
                    foreach ($events as $event) {
                        ?>
                        <option value="<?php echo $event->title ?>"<?php if (@$_GET['start_date'] == $event->title) {
                        echo ' selected';
                    } ?>><?php echo $event->title ?>(<?php echo Event::count_all("WHERE   site_id={$session->site_id} and STR_TO_DATE(`start_date`,'%Y-%m-%d') = '" . $event->title."'" ) ?>)</option>
            <?php } ?>
                </select>
            </form>
<?php
if (isset($_GET['start_date']) && !empty($_GET['start_date'])) {
    $start_date = $database->escape_value($_GET['start_date']);
// start pagination
    $page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
    if (SiteConfig::site_config('paging'))
        $per_page = SiteConfig::site_config('paging');
    else
        $per_page = 20;
    $total_count = Event::count_all("WHERE site_id={$session->site_id} AND STR_TO_DATE(`start_date`,'%Y-%m-%d') = '" . simple_date($start_date) . "'");

    $pagination = new Pagination($page, $per_page, $total_count);
    $sql = "SELECT * FROM events ";
    $sql .= "WHERE STR_TO_DATE(`start_date`,'%Y-%m-%d') = '" . simple_date($start_date) . "' ";
    $sql .= " AND site_id={$session->site_id} ";
    $sql .= "ORDER BY sort_id ASC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $events = Event::find_by_sql($sql);
    ?>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="<?php echo get_current_page(); ?>" method="POST">
                  <?php echo setToken() ?>
                    <table width="100%" class="table table-bordered table-striped table-hover first-table" id="dataTables-example">
                        <thead>
                           <tr>
                                <th><?php echo read_xmls('/site/event/lables/name') ?></th>
                                <th><?php echo read_xmls('/site/event/lables/startdate') ?></th>
                                <th><?php echo read_xmls('/site/event/lables/enddate') ?></th>
                                <th><?php echo read_xmls('/site/event/lables/location') ?></th>
                                <th width='80'><?php echo read_xmls('/site/adminactions/publish') ?></th>
                                <th class="no-sort" width='80'><input  onclick="checkUncheckAll(this)" type="checkbox" value="on" name="checkall" email="<?php echo read_xmls('/site/adminactions/selectall') ?>" /></th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                foreach ($events as $event):
                                 ?>
                                    <tr>
                                        <td><?php echo Event::find_viewed_language('title', intval($event->id), Event::$trans_key) ?></td>
                                        <td align="center"><?php echo $event->start_date ?></td>
                                        <td align="center"><?php echo $event->end_date ?></td>
                                        <td align="center"><?php echo $event->location ?></td>
                                        <td align="center"><?php echo show_published($event->publish); ?></td>
                                        <td align="center"><input type="checkbox" value="<?php echo $event->id; ?>" name="check[]" title="<?php echo $event->title; ?>" <?php if ((is_array($checked_row) && in_array($event->id, $checked_row)) || check_var("checked_row", "GET") == $event->id) {
                                           echo "checked='checked'";
                                          } ?>/></td>
                                    </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                     <table class="button-table" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><div align="<?php echo read_xmls('/site/config/otheralign') ?>">
                                    <?php if ($session->has_permission('EventPublish')) { ?>
                                        <label for='publish' class="fa fa-unlock" aria-hidden="true"></label>
                                       <input class="btn btn-success" name="publish"  type="submit" value="<?php echo read_xmls('/site/adminactions/publish') ?>" id="publish" class="button" />
                                    <?php } ?>
                                    <?php if ($session->has_permission('EventPublish')) { ?>
                                        <label for='unpublish' class="fa fa-lock" aria-hidden="true"></label>
                                       <input class="btn btn-primary" name="unpublish" type="submit" value="<?php echo read_xmls('/site/adminactions/unpublish') ?>" id="unpublish"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('EventMove')) { ?>
                                        <label for='sort_up' class="fa fa-long-arrow-up" aria-hidden="true"></label>
                                       <input class="btn btn-primary" name="sort_up" type="submit" value="<?php echo read_xmls('/site/adminactions/moveup') ?>" id="sort_up"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('EventMove')) { ?>
                                        <label for='sort_down' class="fa fa-long-arrow-down" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="sort_down" id='sort_down' type="submit" value="<?php echo read_xmls('/site/adminactions/movedown') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('EventTranslate')) { ?>
                                        <label for='translate' class="fa fa-language" aria-hidden="true"></label>
                                         <input class="btn btn-info" name="translate" id='translate' type="submit" value="<?php echo read_xmls('/site/adminactions/translate') ?>"  class="button"/>
                                    <?php } ?>
                                    <?php if ($session->has_permission('EventEdit')) { ?>
                                         <label for='edit' class="fa fa-edit" aria-hidden="true"></label>
                                         <input class="btn btn-primary" name="edit" id='edit' type="submit" value="<?php echo read_xmls('/site/adminactions/edit') ?>"  class="button"/>
                                    <?php } ?>
                                        <?php if ($session->has_permission('EventDelete')) { ?>
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

<?php } include_layout_template('admin_footer.php'); ?>
