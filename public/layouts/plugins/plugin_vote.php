<?php
global $session;
get_js('vote' . DS . 'vote.js');
if (VoteQuestion::count_all("WHERE publish=1 AND site_id={$session->site_id}")) {
    $voteQuestion = VoteQuestion::find_all("id DESC LIMIT 1", "WHERE publish=1 AND site_id={$session->site_id}");
    ?>
    <div class="poll_main" id="poll_main">
        <div class="clear"></div>
        <div class="poll_title"><?php echo VoteQuestion::find_viewed_language('title', $voteQuestion[0]->id, VoteQuestion::$trans_key); ?></div>
        <?php
        $vote = new Vote();
        @$vote->settings($voteQuestion[0]->id);
        ?>
    </div>
<?php
} else {
    echo read_xmls('/site/vote/msg/cantfindvote');
}?>
