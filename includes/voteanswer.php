<?php

class VoteAnswer extends DatabaseObject {

    public static $table_name = 'vote_answers';
    protected static $db_fields = array('id', 'title', 'counter', 'question_id', 'sort_id', 'publish', 'lang_id', 'created', 'updated');
    public $id;
    public $title;
    public $counter;
    public $question_id;
    public $sort_id;
    public $publish;
    public $lang_id;
    public $created;
    public $updated;
    public static $trans_key = 'voteanswer';
    public $errors = array();

    public function save_VoteAnswer() {
        if (isset($this->id)) {
            // check required feilds
            if (empty($this->title)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            }
            // check limit chars
            else if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else {
                return $this->update();
            }
        } else {

            // check required feilds
            if (empty($this->title)) {
                $this->errors[] = read_xmls('/site/msg/allrequire');
                return false;
            } else
            // check limit chars
            if (strlen($this->title) >= 255) {
                $this->errors[] = read_xmls('/site/msg/longer');
                return false;
            } else {
                return $this->create();
            }
        }
    }

}

?>
