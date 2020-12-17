<?php

class Subscription extends DatabaseObject {

    public static $table_name = 'subscription';
    protected static $db_fields = array('id', 'full_name', 'account_type', 'gender', 'birth_date', 'profession', 'nationality', 'tel', 'mobile', 'email', 'country', 'program', 'interests', 'created');
    public $id;
    public $full_name;
    public $account_type;
    public $gender;
    public $birth_date;
    public $profession;
    public $nationality;
    public $tel;
    public $mobile;
    public $email;
    public $country;
    public $program;
    public $interests;
    public $created;
    public static $trans_key = 'subscription';
    public $errors = array();

}

?>
