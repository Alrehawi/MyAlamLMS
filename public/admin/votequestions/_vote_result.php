<?php
require_once('../../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("../login/");
}
$session->check_permission('VoteQuestionView', '../');
echo get_css(Language::get_lang_style());
echo"<style>body{background:none;}</style>";
$vote_results = intval($_GET['vote_results']);
if (!empty($vote_results) && VoteQuestion::count_by_field('id', $vote_results)) {
    echo "<div style='width:500px; margin:30px auto;'>";
    echo "<h2>" . read_xmls('/site/vote/lables/result') . "</h2><br />";
    $_GET['results'] = "do";
    $vote = new Vote();
    @$vote->settings($vote_results);
    echo "</div>";
} else {
    echo read_xmls('/site/vote/msg/cantfindvote');
}
?>
<br />