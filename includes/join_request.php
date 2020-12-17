<?php

class JoinRequest extends DatabaseObject {

    public static $table_name = 'join_requests';
    protected static $db_fields = array('id', 'full_name', 'gender', 'birth_date', 'nationality',
                                        'mobile', 'email', 'id_no', 'address', 'photo', 'stage_no', 'level_no'
                                        , 'category_id', 'parent_full_name', 'parent_id_no', 'parent_mobile', 'parent_email', 'created');
    public $id;
    public $full_name;
    public $gender;
    public $birth_date;
    public $nationality;
    public $mobile;
    public $email;
    public $id_no;
    public $address;
    public $photo;
    public $stage_no;
    public $level_no;
    public $category_id;
    public $parent_full_name;
    public $parent_id_no;
    public $parent_mobile;
    public $parent_email;
    public $created;

    public static $trans_key = 'join_requests';
    public $errors = array();

}

?>
