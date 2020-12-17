<?php

class JobRequest extends DatabaseObject {

    public static $table_name = 'job_requests';
    protected static $db_fields = array('id', 'full_name', 'gender', 'mobile', 'email', 'file_id' ,'notes','created');
    public $id;
    public $full_name;
    public $gender;
    public $mobile;
    public $email;
    public $file_id;
    public $notes;
    public $created;

    public static $trans_key = 'job_requests';
    public $errors = array();

}

?>
