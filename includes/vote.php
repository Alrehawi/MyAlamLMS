<?php

class Vote extends DatabaseObject {

    public static $table_name = 'votes';
    protected static $db_fields = array('id', 'question_id', 'answer_id', 'ip_address', 'created');
    public $id;
    public $question_id;
    public $answer_id;
    public $ip_address;
    public $created;
    public $poll_id;
    public $js;
    public $errors = array();

    public function settings($poll_id) {
        if ($poll_id == '')
            $poll_id = $this->check_last_poll(); //if empty we show the latest poll
        $this->poll_id = $poll_id;
        $this->checkJS();
        if (isset($_GET['poll']) and $this->js == 'no')
            $this->votePoll();
        $this->writePoll();
    }

    public function check_last_poll() {
        global $session;
        $question = VoteQuestion::find_all('id DESC', " WHERE site_id={$session->site_id}");
        return $question[0]->id;
    }

    public function votePoll() {
        global $database, $session;
        if (isset($_POST['poll_answer'])) {
            $id = $database->escape_value($_POST['poll_answer']);
            if (!isset($id) || $id == '')
                $this->errors[] = read_xmls('/site/vote/msg/iderror');
            $question_id = VoteAnswer::find_field_by_id('question_id', $id);
            $checkip = self::count_all(" WHERE ip_address='" . $_SERVER['REMOTE_ADDR'] . "' and question_id='" . $question_id . "'");
            if ($checkip != 0)
                $this->errors[] = read_xmls('/site/vote/msg/alreadyvoted');
            if (count($this->errors) == 0) {
                $vote = new self();
                $vote->question_id = $question_id;
                $vote->answer_id = $id;
                $vote->ip_address = $_SERVER['REMOTE_ADDR'];
                $vote->created = current_date();
                $vote->save(); //create vote
                VoteAnswer::increase_counter($id); //increase couner of answer by 1 
            }
        }
    }

    public function checkJS() {

        // check if js is activated
        if (!isset($_GET['js']))
            $_GET['js'] = 'yes';
        if ($_GET['js'] == 'yes') {
            $link = search_for_flag(get_current_page(), 'js', 'no');
            //echo '<noscript><meta http-equiv="refresh" content="0;url='.$link.'" /></noscript>';
            //echo "<noscript>".redirect_to($link)."</noscript>";
        } else {
            echo '
            <script type="text/javascript">
                    var locat=window.location.href;
                    l=locat.replace("js=no", "js=yes");
                    window.location=l;
            </script>
            ';
        }
        $this->js = $_GET['js'];
        // $this->js will be now yes if is activated and no if it's dezactived
    }

    public function writePoll() {
        global $voteAnswersForQue, $checkip, $totalVotes, $voteObject;
        $voteObject = $this;
        $id = $this->poll_id;
        $voteAnswersForQue = VoteAnswer::find_all('sort_id ASC', "WHERE publish=1 AND question_id=" . $id);
        $checkip = self::count_all(" WHERE ip_address='" . $_SERVER['REMOTE_ADDR'] . "' and question_id='" . $id . "'");
        $totalVotes = self::count_all(" WHERE question_id='" . $id . "'");
        //$totalVotes = VoteAnswer::sum_field('counter', " WHERE publish=1 AND question_id='" . $id . "'");
        echo include_layout_template('vote.php');
    }

    public static function check($vt) {
        $x = 0;
        if ($vt <= 25)
            $x = 0;
        elseif ($vt <= 50)
            $x = 60;
        elseif ($vt <= 75)
            $x = 40;
        elseif ($vt <= 100)
            $x = 20;
        return $x;
    }

}

?>
