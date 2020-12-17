<?php
global $voteAnswersForQue, $checkip, $totalVotes, $voteObject;

if (!isset($_GET['results']) && $checkip == 0) {
    ?>
    <div class="poll_answers" id="pollA">
        <form id="pollF"  class="poll_form"
        <?php
        if ($voteObject->js == 'no')
            'action="' . search_for_flag(get_current_page(), 'poll', 'vote') . '"';
        else
            echo 'action="' . search_for_flag(get_current_page(), 'poll', 'vote') . '&amp;js=no" method="post"';
        ?>>
        <?php echo setToken() ?>
                  <?php
                  //voteAnswersForQue is an object use foreach
                  foreach ($voteAnswersForQue as $answer):
                      echo '<label><input type="radio" name="poll_answer" value="' . $answer->id . '"/> ' . VoteAnswer::find_viewed_language('title', $answer->id, VoteAnswer::$trans_key) . '</label>';
                      echo "<br>";
                  endforeach;
                  ?>
            <div class="clear"></div>
            <div class="votesubmit">
                <?php if ($voteObject->js == 'no') { ?>
                    <input type="submit"  class="moreImg" value="<?php echo read_xmls('/site/vote/lables/vote'); ?>"/>
                <?php } else { ?>
                    <input type="submit"  class="moreImg" value="<?php echo read_xmls('/site/vote/lables/vote'); ?>" onclick="javascript: return votez('actions/', '<?php echo $voteObject->poll_id ?>', '<?php echo read_xmls('/site/vote/msg/requiredmsg'); ?>');"/>
    <?php } ?>
            </div>
        </form>
    </div>
    <div class="poll_result" id="pollR"></div>

    <?php
} else {

    //voteAnswersForQue is an object use foreach
    foreach ($voteAnswersForQue as $answer):
        $countanswervote= Vote::count_all(" WHERE answer_id='" . $answer->id . "'");

        $vt = round($countanswervote / $totalVotes * 100, 1);
        $x = Vote::check($vt);
        ?>
        <span class="answer"><?php echo VoteAnswer::find_viewed_language('title', $answer->id, VoteAnswer::$trans_key) ?></span> <span class="percentage"><?php echo $vt . "% (" . $countanswervote . ") " . read_xmls('/site/vote/msg/voted'); ?></span><br />
        <div class="poll_answer_voted">
            <!-- style is for background position ( for the vote bar ... ) -->
            <div class="poll_bar" style="width:<?php echo $vt; ?>%;background-position:0px -<?php echo $x; ?>px;"></div>
        </div>
    <?php endforeach; ?>
    <div class=""></div>

<?php } ?>
