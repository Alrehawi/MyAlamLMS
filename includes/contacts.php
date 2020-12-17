<?php

class Contacts extends DatabaseObject {

    public static $table_name = 'contacts';
    protected static $db_fields = array('id', 'name', 'phone',  'email', 'msg','created','visitor_ip','site_id');
    public $id;
    public $name;
    public $phone;
    public $email;
    public $msg;
    public $created;
    public $visitor_ip;
    public $site_id;

    public static $trans_key = 'contacts';
    public $errors = array();

}

?>
